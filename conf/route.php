<?php
$route['test'] =  new Yaf_Route_Rewrite('test/:name',['controller'=>'index','action'=>'test']);
return $route;