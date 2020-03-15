<?php
function component($productname,$productprice,$productdus,$producttext,$productimg ){
$element="
<div class=\"col-md-3 col-sm-6 my-3 my-md-0\">
     <form action=\"Shopping.php\" method=\"post\">
             <div class=\"card shadow\">
                <div>
                    <img src=\"$productimg\" class=\"img-fluid card-img-top\">
                </div>
                <div class=\"card-body\">
                    <h5 class=\"card-title\" style=\"font-family: cursive;\">$productname</h5>
                    <h6><i class=\"fas fa-star\"></i>
                    <i class=\"fas fa-star\"></i>
                    <i class=\"fas fa-star\"></i>
                    <i class=\"fas fa-star\"></i>
                    <i class=\"far fa-star\"></i>
                    </h6>
                    <p class=\"card-text\">$producttext</p>
                    <h5>
                    <small><s class=\"text-secondary\">$productdus L.E</s></small><br>
                    <span class=\"price\">$productprice L.E</span>
                    </h5>
                    <button type=\"submit\" class=\"btn btn-warning my-3\" named=\"add\">Add to Cart<i class=\"fas fa-shopping-cart\"></i></button>
                </div>
             </div>
            </form>
       </div>";
echo $element;
}

?>
