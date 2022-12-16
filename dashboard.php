<?php
/*
* Plugin Name: myFormulary Plugin
* Description: A plugin to utilize the SASS of myFormulary
* Author: A. Gwek
*/

// Method: POST, PUT, GET etc
// Data: array("param" => "value") ==> index.php?param=value


    

  



function myFormulary_admin_menu()
{
    //Adding the menu to admin menu list
    add_menu_page('myFormulary', 'myFormulary', 'manage_options', 'myFormulary-menu', 'myFormulary_main_menu', 'dashicons-products', 11);

    
}

//Hooking the custom download menu to admin menu of WP
add_action('admin_menu', 'myFormulary_admin_menu');



function myFormulary_main_menu()
{
    $content = '<h1>Welcome to MyFormulary</h1>';
    //$content .= '<h2>Below is a sample of the form</h2>';
    //$content .= '<img src="' . esc_url( plugins_url( 'search-plugin.png', __FILE__ ) ) . '" style="max-width:50%;">';
    //$content .= '<h2>To implement, copy the below shortcode and paste it anywhere in you post or page</h2>';
    
    //$content .= '<input type="text" readonly  value="[search-file]" aria-label="Last name" class="form-control">';

    echo $content;
}

//generating shortcode to be used
function myFormulary_shortcode(){
    //Declaring Global woocommerce
    global $product;
    //Retriving the api response;
    $myFormulary_api_response = file_get_contents('https://www.efficacyengine.net/getProductListByCondition?userID=5a76gwyrTaPbLRMhOF7Iws6iJGJ3&conditionID=141&partnerKey=18938208');
    $formated_response = json_decode($myFormulary_api_response);
    //styling
    $content ='
    <!--------- Stylying Section -----------!>
    <style type="text/css">
        
        .plugin-container {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .plugin-row {
            --bs-gutter-x: 1.5rem;
            --bs-gutter-y: 0;
            display: flex;
            flex-wrap: wrap;
            margin-top: calc(var(--bs-gutter-y)*-1);
            margin-right: calc(var(--bs-gutter-x)/-2);
            margin-left: calc(var(--bs-gutter-x)/-2);
        }

        .col-full {
            flex: 0 0 auto;
            width: 100%;

        }

        .left-side{
            flex: 0 0 auto;
            width: 30%;
        }

        .right-side{
            flex: 0 0 auto;
            width: 70%;
            background-color: #f4f4f4;
        }
        .logo{
            flex: 0 0 auto;
            width: 100%;
            margin-bottom: 15px;
        }
        
        .filter-icon {
            font-size: 18px;
            margin-bottom: 24px;
            margin-top: 26px;
        }
        .filter-icon img{
            width: 24px;
            height: 24px;
        }
        
        .pd-4{
            padding: 20px 10px;
        }

        .form-feilds input{
            margin-bottom: 12px;
        }
        
        .form-feilds input{
            box-sizing: border-box;
            background: #FFFFFF;
            border: 1px solid #C2C9D1;
            border-radius: 12px;
            width: 100%px;
            height: 40px;
            margin-top: 8px;
            color: rgba(0, 0, 0, 0.5);
            padding: 8px 10px;
        }
        .input-group {
            
            display: flex;
        }
        
        
        .form-feilds input:focuss{
            border: 1px solid #007AFF;
        }

        .productTags{

            flex: 0 0 auto;
            padding: 4px 12px;
            background: #744173;
            border-radius: 25px;
            width: 45%;
            color: #ffffff;
            justify-content: center;
            display: flex;
            margin-right: 5px;
            margin-bottom: 8px;
        }

        .productTags span{
            font-size: 1rem;
        }

        .productTags-margin{
            margin-bottom: 24px;
            
        }

        .boarder-bottom-w{
            background: #ffffff;
            border-radius: 2px;
            transform: matrix(1, 0, 0, -1, 0, 0);
            width: 100%;
            height: 5px;
        }

        .boarder-bottom{
            background: #EEEEEE;
            border-radius: 2px;
            transform: matrix(1, 0, 0, -1, 0, 0);
            width: 100%;
            height: 1px;
        }

        .pd-t1{
            margin-top: 24px;
            margin-bottom: 24px;
        }

        .chkbox-filter{
            flex: 0 0 auto;
            width: 100%;
        }

        .chkbox-filter label{
            font-weight: normal !important;
            font-size: 12px;
        }


        .slidecontainer {
            width: 100%;
          }
          
            .priceslide{
            width: 100%;
            background: #d3d3d3;
            outline: none;
            opacity: 0.7;
            -webkit-transition: .2s;
            transition: opacity .2s;
          }
          .price{
            flex: 0 0 auto;
          }

          .price span{
            font-size: 12px; 
          }

          .minprice{
            width: 30%;
            
        }
          .currentprice{
            width: 40%;
            text-align: center;

          }

          .maxprice{
            width: 30%;
        }

        .headerLabel{
           text-align: center;
           padding-top: 20px;
           margin-bottom: 9px;
        }
        .headerLabel img{
            width: 60%;
        }

        .plugin-navbar{
           background-color: #E19B16;
           color: #ffffff;
           display: flex;
           justify-content: center;
           width: 100%;
                      
        }

        .plugin-navbar ul li{
            display: inline-block;
            text-decoration: none;
            font-size: 1rem;
            margin-right: 10px;
            font-weight: 700;
            cursor: pointer;

        }

        .plugin-navbar ul li:hover{
            color: rgba(26, 97, 154, 1);

        }

        .plugin-product-list{
            background-color: #ffffff;
            margin: 20px 20px;
            width: 100%;
            display: flex;
            
        }

        

        .product-card{
            background-color: #ffffff;
            width: 20%;
            border-radius: 12px;
            box-shadow: 0px 4.28897px 21.4449px rgba(0, 0, 0, 0.05);
            padding: 5px;
            justify-content: center;
            margin-right: 21px;
        }
        .product-img{
            width: 100%;
        }
        .product-img img{
            widht: 100%;
        }
        .product-label-holder{
            widht: 100%;
            display: flex;
        }
        .product-price{
            flex: 0 0 auto;
            width: 40%;
            color: #ffffff;
            background-color: #744173;
            border-radius: 25px;
            padding: 5px 5px;
            font-size: 1rem;
        }
        .product-label-tag{
            flex: 0 0 auto;
            color: #ffffff;
            border-radius: 50px;
            text-align: center;
            font-size: 1rem;
            width: 22px;
            height:22px;
            
        }

        .product-label-1{
            background-color: #58842E;
        }

        .product-label-2{
            background-color: #CED92C;
        }

        .product-label-3{
            background-color: #1A619A;
        }
        .product-add-cart{
            flex: 0 0 auto;
            width:100%;
            color: #ffffff;
            padding: 5px 5px;
            background: #744173;
            border: 1.07224px solid #744173;
            border-radius: 4.28897px; 
            text-align: center;


        }
        .product-description{
            font-size: 1.2rem;
        }


            

    </style>




    <!--------- HTML  Section----------->

    <div class="plugin-container">
        
        <div class="plugin-row">
        <!--------- Left Side----------->
            <div class="left-side pd-4">
                <div class="logo">
                    <img src="' . esc_url( plugins_url( '/assets/images/logo-myFormulary.png', __FILE__ ) ) . '" >
                </div>
                <div class="filter-icon">
                    <strong>Filter <i><img src="' . esc_url( plugins_url( '/assets/images/filter-icon.png', __FILE__ ) ) . '"></i></strong>
                </div>

                <div class="input-group form-feilds">                    
                    <input type="text" name="firstName" placeholder="Search Product" required>                    
                </div>

                <div class="plugin-row productTags-margin">
                    <div class="productTags"><span>Omega 3</span></div>
                    <div class="productTags"><span>Omega 3B</span></div>
                    <div class="productTags"><span>Soy Milk</span></div>
                    <div class="productTags"><span>Soy Meal</span></div>
                    <div class="productTags"><span>Soy Protein</span></div>
                </div>

                <div class="boarder-bottom"></div>

                <div class="plugin-row pd-t1">
                    <h4>HEALTH CONDITION</h4>
                    
                    <div class="chkbox-filter">
                        <input type="checkbox" id="achondroplasia" name="achondroplasia" value="Achondroplasia">
                        <label for="achondroplasia"> Achondroplasia</label>
                    </div>
                    <div class="chkbox-filter">
                        <input type="checkbox" id="achondroplasia" name="achondroplasia" value="Achondroplasia">
                        <label for="achondroplasia"> Adenovirus</label>
                    </div>
                    <div class="chkbox-filter">
                        <input type="checkbox" id="achondroplasia" name="achondroplasia" value="Achondroplasia">
                        <label for="achondroplasia"> Adolescents With HIV</label>
                    </div>
                    <div class="chkbox-filter">
                        <input type="checkbox" id="achondroplasia" name="achondroplasia" value="Achondroplasia">
                        <label for="achondroplasia"> AIDS Dementia Complex</label>
                    </div>
                    <div class="chkbox-filter">
                        <input type="checkbox" id="achondroplasia" name="achondroplasia" value="Achondroplasia">
                        <label for="achondroplasia"> AIDS-Related Kaposi`s Sarcoma</label>
                    </div>
                    <div class="chkbox-filter">
                        <input type="checkbox" id="achondroplasia" name="achondroplasia" value="Achondroplasia">
                        <label for="achondroplasia"> AIDS-Related Lymphoma</label>
                    </div>
                    <div class="chkbox-filter">
                        <input type="checkbox" id="achondroplasia" name="achondroplasia" value="Achondroplasia">
                        <label for="achondroplasia"> Allergies And Pregnancy</label>
                    </div>
                    <div class="chkbox-filter">
                        <input type="checkbox" id="achondroplasia" name="achondroplasia" value="Achondroplasia">
                        <label for="achondroplasia"> Alzheimer`s Disease</label>
                    </div>
                    <div class="chkbox-filter">
                        <input type="checkbox" id="achondroplasia" name="achondroplasia" value="Achondroplasia">
                        <label for="achondroplasia"> Anxiety</label>
                    </div>
                </div>


                <div class="boarder-bottom"></div>


                <div class="plugin-row pd-t1">

                    <h4>FILTER BY BRAND</h4>

                    <div class="chkbox-filter">
                        <input type="checkbox" id="achondroplasia" name="achondroplasia" value="Achondroplasia">
                        <label for="achondroplasia"> Hakubaku</label>
                    </div>

                </div>


                <div class="boarder-bottom"></div>



                <div class="plugin-row pd-t1">

                    <h4>FILTER BY DEPARTMENT</h4>

                    <div class="chkbox-filter">
                        <input type="checkbox" id="achondroplasia" name="achondroplasia" value="Achondroplasia">
                        <label for="achondroplasia"> All Noodles</label>
                    </div>
                    <div class="chkbox-filter">
                        <input type="checkbox" id="achondroplasia" name="achondroplasia" value="Achondroplasia">
                        <label for="achondroplasia"> Groceries</label>
                    </div>
                    

                </div>
                

                <div class="boarder-bottom"></div>


                <div class="plugin-row pd-t1">

                    <h4>FILTER BY PRODUCT TYPE</h4>

                    <div class="chkbox-filter">
                        <input type="checkbox" id="achondroplasia" name="achondroplasia" value="Achondroplasia">
                        <label for="achondroplasia"> World Foods</label>
                    </div>
                    

                </div>
                

                <div class="boarder-bottom"></div>


                <div class="plugin-row pd-t1">

                    <h4>FILTER BY FORM</h4>

                    <div class="chkbox-filter">
                        <input type="checkbox" id="achondroplasia" name="achondroplasia" value="Achondroplasia">
                        <label for="achondroplasia"> Others</label>
                    </div>
                    

                </div>
                

                <div class="boarder-bottom"></div>


                <div class="plugin-row pd-t1">

                    <h4>FILTER BY GRADED INGREDIENT</h4>

                    <div class="chkbox-filter">
                        <input type="checkbox" id="achondroplasia" name="achondroplasia" value="Achondroplasia">
                        <label for="achondroplasia"> Buckwheat</label>
                    </div>

                    <div class="chkbox-filter">
                        <input type="checkbox" id="achondroplasia" name="achondroplasia" value="Achondroplasia">
                        <label for="achondroplasia"> Flour</label>
                    </div>

                    <div class="chkbox-filter">
                        <input type="checkbox" id="achondroplasia" name="achondroplasia" value="Achondroplasia">
                        <label for="achondroplasia"> Green Tea</label>
                    </div>

                    <div class="chkbox-filter">
                        <input type="checkbox" id="achondroplasia" name="achondroplasia" value="Achondroplasia">
                        <label for="achondroplasia"> Halal</label>
                    </div>

                    <div class="chkbox-filter">
                        <input type="checkbox" id="achondroplasia" name="achondroplasia" value="Achondroplasia">
                        <label for="achondroplasia"> Kosher</label>
                    </div>

                    <div class="chkbox-filter">
                        <input type="checkbox" id="achondroplasia" name="achondroplasia" value="Achondroplasia">
                        <label for="achondroplasia"> Wheat</label>
                    </div>
                    

                </div>

                

                <div class="boarder-bottom"></div>


                <div class="plugin-row pd-t1">

                <h4>Price Filter</h4>

                <div class="slidecontainer">
                    <input type="range" min="30" max="10000" value="50" class="priceslide" id="myFormularyPrice">
                </div>
                <div class="minprice price"><strong>$30</strong> <span>From<span></div>
                <div class="currentprice price" ><strong>$ </strong><i id="currentPrice"></i> </div>
                <div class="maxprice price"><span>to</span> <strong>$10,000</strong></div>
                

            </div>






                

               
            </div>

            <!--------- Right Side----------->
            <div class="right-side">
                
                <div class="plugin-row">
                    <div class="headerLabel">
                        <img src="' . esc_url( plugins_url( '/assets/images/product_label.png', __FILE__ ) ) . '">
                    </div>               
                </div>

                <div class="boarder-bottom-w"></div>

                <div class="plugin-row">
                    <div class="plugin-navbar">

                        <ul>
                            <li>
                                HIGH CHOLESTEROL
                            </li>
                            <li>
                                HIGH BLOOD PRESSURE
                            </li>
                            <li>
                                HIGH DIABETES
                            </li>
                            <li>
                                ATHLETIC PERFORMANCE
                            </li>
                            <li>
                                IMPROVED MOOD
                            </li>
                        </ul>
                        
                    </div>               
                </div>

                <div class="plugin-row">
                    <div class="plugin-product-list products">';
                    
                    $args = array( 'post_type' => 'product', 'posts_per_page' => 20, 'product_cat' => 'hoodies', 'orderby' => 'date' );
                    $loop = new WP_Query( $args );
                    
                    while ( $loop->have_posts() ) : $loop->the_post();
                    $product = wc_get_product();
                    $price = get_post_meta( get_the_ID(), '_price', true );
                    $title = $product->get_name();
                    


                    //$price->get_price_html();
                   
                    $content .= '

                    <div class="product-card">
                        <a href="'.get_permalink().'">
                            <div class="product-img">
                                '.woocommerce_get_product_thumbnail().'
                            </div>
                        </a>
                        <div class="product-label-holder">
                            <div class="product-price">';
                            
                    $content .=  wc_price( $price );
                            
                    $content .= '</div>
                            <div class="product-label-1 product-label-tag">A</div>
                            <div class="product-label-2 product-label-tag">B</div>
                            <div class="product-label-3 product-label-tag">C</div>
                        </div>
                        <div class="product-description">';

                    $content .= $title;
                    
                    
                    $content .= '</div>
                        
                            <a href="'.site_url().'/cart/?add-to-cart='.get_the_ID().'&quantity=1">
                            <div class="product-add-cart"> Add To Cart
                            </div>
                            </a>
                    </div>
                    ';

                    endwhile;
       
                    

                        
                        
                    $content .= '</div>               
                </div>

            </div>

        </div>
    
    
    
    </div>


    <script>
        var slider = document.getElementById("myFormularyPrice");
        var output = document.getElementById("currentPrice");
        output.innerHTML = slider.value;

        slider.oninput = function() {
        output.innerHTML = this.value;
        }
    </script>

   
    ';

    return $content;
}


add_shortcode('myFormulary', 'myFormulary_shortcode');
    ?>