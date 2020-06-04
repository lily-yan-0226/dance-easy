var myVar = setInterval(function(){ readc() }, 500);

      function readc() {
      $.ajax({
      url : "notice.php",//後臺請求的資料，用的是PHP
      dataType : "json",//資料格式
      type : "post",//請求方式
      cache: false,
      async : false,//是否非同步請求
      success : function(data) {  //如果請求成功，返回資料。
      var html = "";
      var j=0;
      for(var i=0;i<data.length;i++){  //遍歷data陣列
          var ls = data[i];  
          if(ls.if_read==0){
          html += '<li>';
          html += '<form method="POST" action="readed.php">';
          html += '<button type="submit" class="dropdown-item btn">';
          html += '<div class="row">';
          html += '<div class="col-lg-3 col-sm-3 col-3 text-center">';
          html += '<img src="zhizhi.png" class="w-100 rounded-circle">';
          html += '</div>';
          html += '<div class="col-lg-8 col-sm-8 col-8">';
          
          html += '<input type="hidden" name="new_content" value="'+ls.content+'">';
          html += '<input type="hidden" name="new_href" value="'+ls.herf+'">';

          html += '<strong class="text-info">'+ ls.title +'</strong>';
          html += '<div>' + ls.content + '</div>';
          html += '<small class="text-warning">'+ ls.time + '</small>';
          html += '</div>';
          html += '</div>';
          html += '</button>';
          html += '</form>';
          html += '</li>';
          j++;
          }else{
          html += '<li class="bg-gray">';
          html += '<a class="dropdown-item notice" href="'+ls.herf+'">';
          html += '<div class="row">';
          html += '<div class="col-lg-3 col-sm-3 col-3 text-center">';
          html += '<img src="zhizhi.png" class="w-100 rounded-circle">';
          html += '</div>';
          html += '<div class="col-lg-8 col-sm-8 col-8">';
          html += '<strong class="text-info">'+ ls.title +'</strong>';
          html += '<div>' + ls.content + '</div>';
          html += '<small class="text-warning">'+ ls.time + '</small>';
          html += '</div>';
          html += '</div>';
          html += '</a>';
          html += '</li>';
          }
        }
        if(j>0){
            $("#notice_dropdown").css('color','rgb(233, 212, 24)');
        }
        if(j==0){
            $("#notice_dropdown").css('color','rgb(138, 134, 100)');
        }
        
        $("#span_news").text('Notifications('+j+')');
        $("#new_notice").html(html); //在html頁面id=test的標籤裡顯示html內容
      },
    })
    }
    var XHR = null;  
         
      function startRequest_bell()
      {
        XHR = createXMLHttpRequest();
        XHR.open("GET", "Mark.php");
        // XHR.onreadystatechange = handleStateChange;          
        XHR.send(null);
      }