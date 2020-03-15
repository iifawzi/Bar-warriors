<?php
function component($productname,$productprice,$productdus,$producttext,$productimg,$code ){
$element="<div class=\"col-md-3 col-sm-6 my-3 my-md-0\">
    <form  method=\"post\">
     <input name=\"productcode\" value='$code' style=\"  visibility: hidden;\">
             <div class=\"card shadow\" >
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
                    <label for=\"quantity\">Quantity</label>
                    <input type=\"number\" value=\"0\" id=\"quantity\" name=\"quantity\" min=\"1\" max=\"100\" style=\" width:30px;\"></input>
                    <button type=\"submit\" class=\"btn btn-warning my-3\" name=\"add\">Add to Cart<i class=\"fas fa-shopping-cart\"></i></button>
                </div>
             </div>       
       </div>
    </form>

";
echo $element;

}

?>
