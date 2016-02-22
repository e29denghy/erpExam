 $(document).ready(function(){
             
            //设置第一个上移的按钮为不可用
              var timer=null;
      <!--  copy 事件 复制表单 id  -->
              $("#copy").live("click",function(){
				
                var list=$(this).parents("table").find("select[name='1'] option:selected").val();
                //alert(list);
                var opetation=$(this).parents("table").find("select[name='2'] option:selected").val();
                var chara=$(this).parents("table").find("select[name='3'] option:selected").val();
                
                var id=parseInt($(this).parents("table").attr("id"));

                copyForm(id,list,opetation,chara);
				changeBlanceStart();
				buttonState();
				
//				alert((parseInt($(this).parents(".AnswForm").attr("id"))+1+''));
//				alert($(".AnswForm:last").attr("id"));
				if((parseInt($(this).parents(".AnswForm").attr("id"))+1+'') ==
				$(".AnswForm:last").attr("id")){
					window.location.href="#upFlowAnsw";
				}
          		$(this).parents(".AnswForm").css("background-color","#D0E8F9");
          		$(this).parents(".AnswForm").siblings('.AnswForm').css("background-color","#D0E8F9");
				$(this).parents(".AnswForm").next().css("background-color","#89C7F4");
                timer=setTimeout(function(){
                	$(".AnswForm").css("background-color","#D0E8F9");
                },2000);
              })
              <!--  delete 事件 删除表单 id  -->
              $("#delete").live("click",function(){
               
                if(($("table").length)>1){
                  $(this).parents("table").remove();
                }else{
                  alert("这是最后一个表单！");
                }
                initId();
                changeBlanceStart();
                buttonState();
              })
               <!--  up 事件 上移表单 id  -->
               $("#up").live("click",function(){
                var lastId=parseInt($(this).parents("table").attr("id"))-1;
                $(this).parents("table").insertBefore("table[id='"+lastId+"'] ");
                initId();
                buttonState();
              })
               <!--  down 事件 下移表单 id  -->
               $("#down").live("click",function(){
                var lastId=parseInt($(this).parents("table").attr("id"))+1;
                $(this).parents("table").insertAfter("table[id='"+lastId+"'] ");
                initId();
                buttonState();
              })
              buttonState();
      })
 //设置第一个上衣按钮 和最后一个下移的按钮 为不可用
        function buttonState(){
		   $(".AnswForm:last").find("#down").attr("disabled",true);
		   $(".AnswForm:not(:last)").find("#down").attr("disabled",false);
		   
		   $(".AnswForm:first").find("#up").attr("disabled",true);
		   $(".AnswForm:not(:first)").find("#up").attr("disabled",false);
        }
        

        function getByClass(className){         //没有根据id来复制特定的表格
            var ret=new Array();
            var obj=document.getElementsByTagName("*");
            for(i=0;i<obj.length;i++){
              if(obj[i].className==className){
                ret.push(obj[i]);
              }
            }
            return ret;
          }
          
          function addEvent(obj,even,fun){
            if(obj.attachEvent){
              obj.attachEvent("on"+even,function(){
                if(false==fun.call(obj)){
                  event.cancelBubble=true;        //取消事件冒泡
                  return false;
                }
              });
             
            }
            else{
              obj.addEventListener(even,function(){
                if(false==fun.call(obj)){
                  event.cancelBubble=true;
                  return false;
                }
              },false);
            }
          } 
          var arr=new Array();
          <!--  从新排序 id  -->
          function initId(){
            var l=getByClass('AnswForm');
            
            for(var i=0;i<l.length;i++){             
              l[i].setAttribute("id",i+1);              
              $(l[i]).find(".step").text(i+1);
            }
            buttonState();
          }
          <!--  复制表单 id  -->

          function copyForm(id,list,opetation,chara){
            var fa=$(".rAnswArea");
            var kid=$("table[id="+id+"]");

            var cloneKid=kid.clone();
            var aId=parseInt(kid.get(0).getAttribute("id"))+1;
            
            cloneKid.get(0).setAttribute("id",aId);
            cloneKid.find(".step").text(aId);
            cloneKid.find("select[name='1'] option[value='"+list+"']").attr("selected","selected");

            cloneKid.find("select[name='2'] option[value='"+opetation+"']").attr("selected","selected");

            cloneKid.find("select[name='3'] option[value='"+chara+"']").attr("selected","selected");
            cloneKid.insertAfter("table[id="+id+"]");
            
            initId();
          }
          
	$("#copy,#delete,#up,#down").live("click",function(){
		$(this).parents(".AnswForm").css("background-color", "#D0E8F9");
	});
	
	$("select[name=1],select[name=2],select[name=3],").live("click",function(){
		$(this).parents(".AnswForm").css("background-color", "#D0E8F9");
	});