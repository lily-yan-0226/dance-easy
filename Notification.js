
 var a = setInterval(function(){ readn() }, 500);

 function readn() {
    $.ajax({
    url : "Notification.php",//後臺請求的資料，用的是PHP
    dataType : "json",//資料格式
    type : "post",//請求方式
    cache: false,
    async : false,//是否非同步請求
    success : function(data) {  //如果請求成功，返回資料。
    for(var i=0;i<data.length;i++){  //遍歷data陣列
        var ls = data[i];  
        
            if (!('Notification' in window)) {
                console.log('This browser does not support notification');
            }
            if (Notification.permission === 'default' || Notification.permission === 'undefined') {
                Notification.requestPermission() ;
            }

            if (Notification.permission === 'granted') {
            // 使用者同意授權
            var notify = new Notification('來自: 吱吱課評網~', {
              body: ls.title,
              icon: 'zhizhi.png',
            }); // 建立通知

            setTimeout(function() {
                notify.close();
                }, 3000);

            }
            
           
       

        
      }
    },
  });
  }

