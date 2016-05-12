<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'ReduxFramework_table' ) ) {
    class ReduxFramework_table {

        /**
         * Field Constructor.
         * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
         *
         * @since ReduxFramework 1.0.0
         */
        function __construct( $field = array(), $value = '', $parent ) {
            $this->parent = $parent;
            $this->field  = $field;
            $this->value  = $value;
        }

        /**
         * Field Render Function.
         * Takes the vars and outputs the HTML for the field in the settings
         *
         * @since ReduxFramework 1.0.0
         */
        function render() {
			global $redux_demo;
			
            if ( ! empty( $this->field['data'] ) && empty( $this->field['options'] ) ) {
                if ( empty( $this->field['args'] ) ) {
                    $this->field['args'] = array();
                }

                $this->field['options'] = $this->parent->get_wordpress_data( $this->field['data'], $this->field['args'] );
                $this->field['class'] .= " hasOptions ";
            }

            if ( empty( $this->value ) && ! empty( $this->field['data'] ) && ! empty( $this->field['options'] ) ) {
                $this->value = $this->field['options'];
            }

 			if(!empty($this->field['table'])):
				$tableData=$this->field['table'];				
					
					echo "<table class='field-tables'>";
						echo "<tr>";
						$st=1;
						foreach($tableData['head'] as $key=>$value){
							echo "<th class='".(($st==1)?"name_th":"")."'>".$value."</th>";
							$st++;
						}
						echo "</tr>";
						foreach($tableData['data'] as $key_data=>$key_row){
							echo "<tr>";
								foreach($key_row as $key_data=>$key_value){
									echo "<td>";								
										if($key_value['type']=='name'):
											echo $key_value['name'];
										elseif($key_value['type']=='checkbox'):	
												//echo '<label for="redux_demo_'.$key_value['id'].'">
													echo '<input type="checkbox" data-val="1" name="redux_demo['.$key_value['id'].']" value="1" '.((isset($redux_demo[$key_value['id']]) && $redux_demo[$key_value['id']]==1)?'checked':'').'/>';
												//echo '</label>';
										elseif($key_value['type']==''):	
											echo '--NA--';
										elseif($key_value['type']=='text'):
											echo '<input id="'.$key_value['id'].'" class="sequence-text " type="text" value="'.((isset($redux_demo[$key_value['id']]))?$redux_demo[$key_value['id']]:'').'" name="redux_demo['.$key_value['id'].']">';
										endif;
									echo "</td>";
								}	
							echo "</tr>";
						}
						
					
					
					echo "</table>";
			endif;
        }

        /**
         * Enqueue Function.
         * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
         *
         * @since ReduxFramework 3.0.0
         */
        function enqueue() { 
            if ($this->parent->args['dev_mode']) {
                wp_enqueue_style(
                    'redux-field-table-css',
                    ReduxFramework::$_url . 'inc/fields/table/field_table.css',
                    array(),
                    time(),
                    'all'
                );
            }
        }
    }
}