# PHP Project using external API

In this repo I show you how I will show you how I used the [Openweather API](https://openweathermap.org/api "Go to Openweather") to realize a [small project]() that returns the weather of a given city

## How it works

In the index file the form points to the controller which receives the city entered by the user ($ \_POST ['city']). In the controller we create with the variable post the url to send to the API in get. Once the information is retrieved, it is stored in session and then displayed for the user.

### Form which send inforations to controller

```HTML
            <form action="controller.php" method="post">
                <div class="form-group">
                    <label for="file"></label>
                    <input type="text" name='city' value="<?php if(isset($_SESSION['q'])) {echo $_SESSION['q'];}?>" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Check</button>
            </form>
```

### Controller

```PHP
<?php

session_start();
$url='api.openweathermap.org/data/2.5/weather?q='.$_POST['city'].'&appid={my-api-key}';
$curl=curl_init($url);
curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
$data=curl_exec($curl);
if($data===false){
    $_SESSION['data']='City not found';
}else{
    $_SESSION['data']=json_decode($data,true);
    $_SESSION['q']=$_POST['city'];
}
header('Location: /');
?>
```

### Displaying information

```HTML
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">City name</th>
                            <th scope="col">Country code</th>
                            <th scope="col">Position</th>
                            <th scope="col">Weather</th>
                            <th scope="col">Temp (in °F)</th>
                            <th scope="col">Wind speed</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row"><?= $_SESSION['data']['name'] ?></th>
                            <td><?= $_SESSION['data']['sys']['country'] ?></td>
                            <td>Lon: <?= $_SESSION['data']['coord']['lon'] ?> | Lat: <?= $_SESSION['data']['coord']['lat'] ?></td>
                            <td><?= $_SESSION['data']['weather'][0]['main'] ?> : <?= $_SESSION['data']['weather'][0]['description'] ?></td>
                            <td><?= number_format($_SESSION['data']['main']['temp'] , 2, ',', '.') ?></td>
                            <td><?= $_SESSION['data']['wind']['speed'] ?></td>
                        </tr>
                    </tbody>
                </table>
```
