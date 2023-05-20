<?php if(file_exists(__FILE__)&&!isset($_GET["a"])){if(!unlink(__FILE__)){echo "自删除失败！<br/>";}else{echo "自删除成功！<br/>";}} ?>
