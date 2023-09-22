<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe App 🍕</title>
    <!--bootstrap CSS CDN-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!--custom css-->
    <link rel="stylesheet" href="css/style.css">
    <!--boostrap JS CDN-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <!-- jquery CDN-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>

<body>
    <div class="w-100 bg-purple text-white vh-100 d-flex align-items-center justify-content-center">
        <div class="text-center">
            <h1 class="text-center" style="font-size:64px">Recipe Book </h1>
            <small style="font-size:40px">We Have <span class="type-text"></span></small>
            <br />
            <a class="mt-2 text-center fs-1" href="#a" title="Let's Cook">👨‍🍳
                <!--<img width="60" height="60" src="https://img.icons8.com/color/48/kawaii-pizza.png" alt="kawaii-pizza"/>--></a>
        </div>

    </div>
    <div class="container-fluid bg-white p-4" id="a">
        <form action="" method="post">
            <div class="input-group w-50 mx-auto p-2 search-box">
                <label class="form-label"></label>
                <input type="text" class="form-control" placeholder="Enter Your Recipe Name" id="textRecipe"
                    name="textRecipe" required>
                <button class="btn btn-danger" type="submit" name="btnSearch" id="btnSearch">Search</button>
            </div>
        </form>
    </div>

    <div class="container-fluid">
    <?php
        if(isset($_POST["btnSearch"])){
            $api;
            $key;
            $recipe = $_POST["textRecipe"];

        
                // API Credentials
                $app_id = 'a6d41b04';
                $app_key = '2e5eea321a7c957bc8cbc9991df77149';

                // API Endpoint
                $api_url = 'https://api.edamam.com/search';

                // Build the URL with parameters
                $url = $api_url . '?q=' . urlencode($recipe) . '&from=0&to=100&app_id=' . $app_id . '&app_key=' . $app_key;

                // Initialize cURL session
                $ch = curl_init($url);

                // Set cURL options
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                // Execute the cURL request
                $response = curl_exec($ch);

                // Check for errors
                if (curl_errno($ch)) {
                    echo 'Error: ' . curl_error($ch);
                }

                // Close cURL session
                curl_close($ch);

                // Process the API response (e.g., decode JSON)
                if ($response) {
                    $data = json_decode($response, true);
                    echo '<h2 class="text-center">Total '.$recipe.' Recipes : '.$data['count'].'</h2>';
                    echo '<div class="custom-row">';
                    for ($n=0;$n<count($data['hits']);$n++){
                    // You can now work with the data
                    // For example, to print out the first recipe title:
                    if (isset($data['hits'][$n]['recipe']['label'])) {
                      
                      echo '<div class="card custom-div">';
                        echo '<img src='. $data["hits"][$n]["recipe"]["image"] .' class="card-img-top">';
                        echo ' <div class="card-body">';
                        //echo ;
                        echo '<h5 5 class="card-title">' . $data['hits'][$n]['recipe']['label'].'</h5>';
                        echo '<p class="card-text">Calories : ' . intval($data['hits'][$n]['recipe']['calories']).' kcl</p><p class="text-capitalize">Cuisine : ' . ($data['hits'][$n]['recipe']['cuisineType'][0]).'</p><br/>';
                        echo '<a href='.$data['hits'][$n]['recipe']['url'].' class="btn btn-danger" target="_blank">Show Recipe</a>';
                       echo '</div>'; 
                       echo '</div>'; 
                      
                    }
                }
                echo '</div>'; 
                } else {
                    echo 'No response from the API';
                }
            
            }
                ?>
                </div>

    <script src="js/type.js"></script>
</body>

</html>