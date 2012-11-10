<?php

// http://www.yiiframework.com/forum/index.php/topic/20495-disable-checkbox-in-ccheckboxcolumn-based-on-attribute-value/
class ECheckBoxColumn extends CCheckBoxColumn
{
        public $disabled;
        protected function renderDataCellContent($row,$data)
        {
                if($this->disabled!==null)
                        $this->checkBoxHtmlOptions['disabled']=$this->evaluateExpression($this->disabled,array('data'=>$data,'row'=>$row));
                parent::renderDataCellContent($row,$data);
        }

    /**
	 * Initializes the column.
	 * This method registers necessary client script for the checkbox column.
	 * Modified to fix "check all" function to not check disabled boxes
	 */
	public function init()
	{
		if(isset($this->checkBoxHtmlOptions['name']))
			$name=$this->checkBoxHtmlOptions['name'];
		else
		{
			$name=$this->id;
			if(substr($name,-2)!=='[]')
				$name.='[]';
			$this->checkBoxHtmlOptions['name']=$name;
		}
		$name=strtr($name,array('['=>"\\[",']'=>"\\]"));

		if($this->selectableRows===null)
		{
			if(isset($this->checkBoxHtmlOptions['class']))
				$this->checkBoxHtmlOptions['class'].=' select-on-check';
			else
				$this->checkBoxHtmlOptions['class']='select-on-check';
			return;
		}

		$cball=$cbcode='';
		if($this->selectableRows==0)
		{
			//.. read only
			$cbcode="return false;";
		}
		elseif($this->selectableRows==1)
		{
			//.. only one can be checked, uncheck all other
			$cbcode="$(\"input:not(#\"+this.id+\")[name='$name']\").prop('checked',false);";
		}
		elseif(strpos($this->headerTemplate,'{item}')!==false)
		{
			//.. process check/uncheck all
			$cball=<<<CBALL
$(document).on('click','#{$this->id}_all',function() {
	var checked=this.checked;
    $("input[name='$name']").each(function() {if(!this.disabled) { this.checked=checked; } });
});

CBALL;
			$cbcode="$('#{$this->id}_all').prop('checked', $(\"input[name='$name']\").length==$(\"input[name='$name']:checked\").length);";
		}

		if($cbcode!=='')
		{
			$js=$cball;
			$js.=<<<EOD
$(document).on('click', "input[name='$name']", function() {
	$cbcode
});
EOD;
			Yii::app()->getClientScript()->registerScript(__CLASS__.'#'.$this->id,$js);
		}
	}
}

?>