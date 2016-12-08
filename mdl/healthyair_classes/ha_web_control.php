<?php
	class ha_web_control {
		var $tag, $properties, $inner_controls, $text;
		function ha_web_control($tag) {
			$this->tag = $tag;
			$inner_controls = array();
			$properties = array();
			$this->text = "";
		}	

		function insert_control($control) {
			$count = count($inner_controls);
			$this->inner_controls[$count] = $control;
		}

		function set_property($property_name, $property_val) {
			$this->properties[$property_name] = $property_val;
		}

		function set_text($text) {
			$this->text = $text;
		}

		function print() {
			printf("<%s ", $this->tag);

			foreach ($this->properties as $property => $value)
    			printf('%s="%s" ', $property, $value);

    		echo ">";

    		for ($i = 0; $i < count($this->inner_controls); $i++)
    			$this->inner_controls[$i]->print();

    		echo $this->text;

    		printf("</%s>", $this->tag);
		}
	}	
?>