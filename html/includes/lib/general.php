<?php 

function displayAllErrors($errors) {
    
      if (count($errors)) {
        echo "<ul class=\"error\">\n";
        foreach (array_keys($errors) as $key) {
            $section = $errors[$key];
            for ($i = 0, $count=count($section); $i < $count; $i++) {
               echo "<li>".$section[$i]."</li>\n";
            }
        }
		echo "</ul>\n";
      }
   }

   ?>