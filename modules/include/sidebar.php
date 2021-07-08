<?php

require_once('../roots.php');
require_once($root. 'include/variables.php');
require_once($root.'include/language/default.php');
require_once($root.'include/document_files.php');
require_once($root2.'classes/navigations.php');
$class_nav = new navigations();
$sidebar = $class_nav->get_sidebar();

?>  

    <!-- Sidebar wrapper Starts -->

          <nav id="sidebar">
            <div class="p-4 pt-5">
              <a href="#" class="img logo rounded-circle mb-5" style="background-image: url(assets/images/logo.png); background-size: contain"></a>
              <ul class="list-unstyled components mb-5">
                <?php

                  echo create_sidebar(0);

                  function create_sidebar($parent)
                  {
                    global $sidebar;
                    $temp = '';
                    foreach ($sidebar as $key => $value) 
                    {
                      $content = '';
                      if($value['parent'] == $parent)
                      {
                        $content = create_sidebar($value['id']);
                        $class = $content != ''? 'class = "dropdown-toggle"' : '';
                        if($content != "")
                        {
                          $content = '<ul class="collapse list-unstyled" id = "TagID'.$value['id'].'">'.$content.'</ul>';
                        }

                        $link = $content != ""? '#TagID'.$value['id'] : 'modules/'.$value['href'];
                        $extraTags = $content != ""? 'data-toggle="collapse" aria-expanded="false"' : '';


                        $temp .= '<li>';
                        $temp .= '<a href="'.$link.'" '.$extraTags.' '.$class.'>'.$value['name'].'</a>';
                        $temp .= $content;
                        $temp .= '</li>';
                      }
                    }
                    return $temp;
                  }

                ?>
              </ul>





              <div class="footer">
                <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved </p>
              </div>

            </div>
          </nav>
   <!-- Sidebar wrapper Ends -->