            function triggerStatus(flag){
                var contentTrigger = '<input class="loadmore" type="button" value="Data empty" disabled">';
                if(flag == 1){
                    contentTrigger = '<input class="loadmore" type="button" value="Load More News" onclick="loadNextPage()">'
                }else if(flag == 2){
                    contentTrigger = "<img class='ajaxload' src='themes/total/images/loader5.gif'>";
                }
                document.getElementById("triggerbutton").innerHTML = contentTrigger;
            }

            function loadNextPage(){
                var lastPageSplitter = $(".imgNews:last").attr("id").split("_");
                var lastPage = lastPageSplitter[1];

                $.ajax({
                    url: "themes/total/ajax_loadnews.php?last_page="+lastPage,
                    dataType: "html",
                    beforeSend: function(){
                        triggerStatus(2);
                    },  
                    success: function(result){
                        if(result != ""){
                            $(".imgNews:last").after(result);
                            triggerStatus(1);
                        }else{
                            triggerStatus(3);
                        }
                    },
                    error: function(xhr, textStatus, errorThrown){
                        triggerStatus(3);
                    }

                });


            }

            $(window).scroll(function(){
                if( ( $(window).scrollTop() ) ==( $(document).height() - $(window).height() ) ){
                    loadNextPage();
                }
            });