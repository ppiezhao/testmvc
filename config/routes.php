<?php

use NoahBuscher\Macaw\Macaw;

echo "<pre>";

Macaw::get('fuck', function(){
	echo "成功！";
});
//
Macaw::get('(:all)', function($fu) {
	echo "未陪配到路由<br/>".$fu;
});

Macaw::get('aa','HomeController@home');
Macaw::dispatch();


