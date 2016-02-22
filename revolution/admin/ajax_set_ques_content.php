<?php
require "../share/function/sqlHelper.php";
require "../admin/function_get_selectlist.php";
require "../admin/function_handle_paper.php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<!-- saved from url=(0041)http://fslh.wisea.cn/mysoft/sim_excel.htm -->
<HTML>
	<HEAD>
		<TITLE>
			仿Excel表格演示
		</TITLE>
		<META http-equiv=Content-Type content="text/html; charset=utf-8">
		<META http-equiv=MSThemeCompatible content=No>
		<SCRIPT type=text/JavaScript>//////////////////////////////////////////变量—初始化///////////////////////////////////////
var toBeColor = "#F8F9FC";
var backColor = "#FFFFFF";
var tableId = "tbData";
var table;
var tbody;
var divShowInput;
window.onload = function() {
	beginListen();
	table = document.getElementById(tableId);
	tbody = table.getElementsByTagName("tbody")[0];
	actionFill();
	otherFill();
	creatDiv();
	divShowInput = document.getElementById("divShowInput");
}

function creatDiv() {
		var filldiv = document.createElement("div");
		filldiv.setAttribute("id", "divShowInput");
		var barp = document.createElement("p");
		barp.setAttribute("id", "barTitle");
		barp.onclick = hideDiv;
		var defComP = document.createElement("p");
		defComP.setAttribute("id", "defComP");
		defComP.onclick = hideDiv;
		var cleara = document.createElement("a");
		cleara.setAttribute("href", "javascript:void 0");
		cleara.onclick = clearInput;
		var clearatext = document.createTextNode("清空");
		cleara.appendChild(clearatext);
		defComP.appendChild(cleara);
		var autoP = document.createElement("P");
		autoP.setAttribute("id", "autoFillP");
		filldiv.appendChild(barp);
		filldiv.appendChild(defComP);
		filldiv.appendChild(autoP);
		document.body.appendChild(filldiv);
	}
	//////////////////////////////////////////变量—_初始化///////////////////////////////////////
	//////////////////////////////////////////动作填充///////////////////////////////////////

function actionFill() {
	var dbinputs = tbody.getElementsByTagName("input");
	for (var i = 1; i <= dbinputs.length - 1; i++) {
		dbinputs[i].onfocus = stopListen;
		dbinputs[i].onblur = beginListen;
		dbinputs[i].ondblclick = showDiv;
		dbinputs[i].onmouseover = onChangTrColor;
		dbinputs[i].onmouseout = outChangTrColor;
		dbinputs[i].onclick = readyedit;
		dbinputs[i].onkeydown = gonext;
	}
	var dbselects = tbody.getElementsByTagName("select");
	for (var i = 0; i <= dbselects.length - 1; i++) {
		dbselects[i].onfocus = stopListen;
		dbselects[i].onblur = beginListen1;
		dbselects[i].onmouseover = onChangTrColor;
		dbselects[i].onmouseout = outChangTrColor;
		dbselects[i].onclick = readyedit1;
		dbselects[i].onkeydown = gonext;
	}
}

function otherFill() {
		var Bt_selectAll = document.getElementById("Bt_selectAll");
		Bt_selectAll.setAttribute("href", "javascript:void 0");
		Bt_selectAll.onclick = selectAll;
		var Bt_delSelect = document.getElementById("Bt_delSelect");
		Bt_delSelect.setAttribute("href", "javascript:void 0");
		Bt_delSelect.onclick = delSelect;
		var Bt_addTr = document.getElementById("Bt_addTr");
		Bt_addTr.setAttribute("href", "javascript:void 0");
		Bt_addTr.onclick = addTr;
		var Bt_copySelect = document.getElementById("Bt_copySelect");
		Bt_copySelect.setAttribute("href", "javascript:void 0");
		Bt_copySelect.onclick = copySelect;
		/*var Bt_allclear = document.getElementById("Bt_allclear");
		Bt_allclear.setAttribute("href","javascript:void 0");
		Bt_allclear.onclick=allClear;*/
		var Bt_sendData = document.getElementById("Bt_sendData");
		Bt_sendData.setAttribute("href", "javascript:void 0");
		Bt_sendData.onclick = sendData;
		var Back_makePaper = document.getElementById("Back_makePaper");
		Back_makePaper.setAttribute("href", "javascript:void 0");
		Back_makePaper.onclick = to_back;
	}
	//////////////////////////////////////////动作填充///////////////////////////////////////
	//////////////////////////////////////////处理鼠标事件///////////////////////////////////////
	//表格变色

function onChangTrColor(event) {
	var e = event || window.event;
	var obj = e.target || e.srcElement;
	obj.parentNode.style.backgroundColor = toBeColor;
	obj.style.backgroundColor = toBeColor;
	var inputs = obj.parentNode.parentNode.getElementsByTagName("input");
	for (var i = 0; i < inputs.length; i++) {
		inputs[i].style.backgroundColor = toBeColor;
		inputs[i].parentNode.style.backgroundColor = toBeColor;
	}
}

function outChangTrColor(event) {
		var e = event || window.event;
		var obj = e.target || e.srcElement;
		obj.parentNode.style.backgroundColor = backColor;
		obj.style.backgroundColor = backColor;
		var inputs = obj.parentNode.parentNode.getElementsByTagName("input");
		for (var i = 0; i < inputs.length; i++) {
			inputs[i].style.backgroundColor = backColor;
			inputs[i].parentNode.style.backgroundColor = backColor;
		}
	}
	//////////////////////////////////////////处理鼠标事件///////////////////////////////////////
	//////////////////////////////////////////处理页面操作///////////////////////////////////////
	//回到组卷页面

function to_back() {
		window.location.href = '../admin/mana_form_exam_paper.php';
	}
	//复制所选

function copySelect() {
	var checkboxs = document.getElementsByName("checkbox");
	for (var i = 0; i < checkboxs.length; i++) {
		if (checkboxs[i].checked == true) {
			checkboxs[i].checked = false;
			copyTr(checkboxs[i]);
			checkboxs[i].checked = true;
		}
	}
	actionFill();
}

function copyTr(obj) {
		var tbody = document.getElementById("tbData").getElementsByTagName("tbody")[0];
		var Str = obj.parentNode.parentNode;
		var tr = Str.cloneNode(true);
		tbody.appendChild(tr);
	}
	//删除所选

function delSelect() {
	var checkboxs = document.getElementsByName("checkbox");
	var tr = table.getElementsByTagName("tr");
	for (var i = 0; i < checkboxs.length; i++) {
		if (tr.length == 2) {
			checkboxs[i].checked = false;
			return;
		}
		if (checkboxs[i].checked == true) {
			removeTr(checkboxs[i]);
			i = -1;
		}
	}
}

function removeTr(obj) {
		var sTr = obj.parentNode.parentNode;
		sTr.parentNode.removeChild(sTr);
		getTotal();
	}
	//全选按钮

function selectAll() {
		var checkboxs = document.getElementsByName("checkbox");
		var mark = true;
		for (var i = 0; i < checkboxs.length; i++) {
			if (checkboxs[i].checked == false) {
				mark = false
			}
		}
		if (mark) {
			for (var i = 0; i < checkboxs.length; i++) {
				checkboxs[i].checked = false;
			}
		} else {
			for (var i = 0; i < checkboxs.length; i++) {
				checkboxs[i].checked = true;
			}
		}
	}
	//鼠标点击聚焦

function readyedit(event) {
	var e = event || window.event;
	var obj = e.target || e.srcElement;
	obj.select();
}

function readyedit1(event) {
		var e = event || window.event;
		var obj = e.target || e.srcElement;
		obj.style.color = '#000';
	}
	//清空
	/*function allClear(){
	var inputs = tbody.getElementsByTagName("input");
	for (var i=0;i<inputs.length;i++) {
	inputs[i].value="";
	}
	}*/
	//全部删除

function allDel() {
		var trs = tbody.getElementsByTagName("tr");
		//alert(trs.length);
		for (var i = 1; i <= trs.length; i++) {
			if (typeof(trs[i]) != "undefined") {
				tbody.removeChild(trs[i]);
				i = 0;
			}
		}
	}
	//////////////////////////////////////////处理页面操作///////////////////////////////////////
	//////////////////////////////////////////处理键盘操作///////////////////////////////////////
	//键盘事件

function beginListen() {
	getTotal();
	if (document.addEventListener) {
		document.addEventListener("keydown", keyDown, true);
	} else {
		document.attachEvent("onkeydown", keyDown);
	}
}

function getTotal() {
	var flownum = document.getElementsByName("A3");
	var flowscore = document.getElementsByName("A5");
	var conceptnum = document.getElementsByName("A6");
	var conceptscore = document.getElementsByName("A8");
	var score = 0;
	for (var i = 0; i < flownum.length; i++) {
		score = score + flownum[i].value * flowscore[i].value;
		score = score + conceptnum[i].value * conceptscore[i].value;
	}
	score = score.toFixed(2);
	document.getElementById("total").innerHTML = score;
}

function beginListen1(event) {
	var e = event || window.event;
	var obj = e.target || e.srcElement;
	obj.style.color = '#999';
	if (document.addEventListener) {
		document.addEventListener("keydown", keyDown, true);
	} else {
		document.attachEvent("onkeydown", keyDown);
	}
}

function stopListen() {
		if (document.removeEventListener) {
			document.removeEventListener("keydown", keyDown, true);
		} else {
			document.detachEvent("onkeydown", keyDown);
		}
	}
	//处理键盘事件

function keyDown(event) {
		var e = event || window.event;
		if (e.keyCode == 45) {
			addTr()
		}
		if (e.keyCode == 46) {
			delTr()
		}
	}
	//增加表格

function addTr() {
		var sTr = tbody.getElementsByTagName("tr")[0];
		var tr = sTr.cloneNode(true);
		tbody.appendChild(tr);
		actionFill();
		tbody.lastChild.firstChild.firstChild.value = 'new';
		getTotal();
	}
	//删除表格

function delTr() {
		var tr = table.getElementsByTagName("tr");
		if (tr.length == 2) {
			return;
		}
		var lastTr = tr[tr.length - 1];
		lastTr.parentNode.removeChild(lastTr);
	}
	//移动焦点

function gonext(event) {
		var e = event || window.event;
		var obj = e.target || e.srcElement;
		if (e.keyCode == 13) {
			var nextobj = obj.parentNode.parentNode.nextSibling;
			var objindex = obj.parentNode.cellIndex;
			if (nextobj) {
				if (nextobj.nodeType == 3) {
					var nextinput = nextobj.nextSibling.getElementsByTagName("input")[objindex];
					nextinput.focus();
					nextinput.select();
				} else {
					var nextinput = nextobj.getElementsByTagName("input")[objindex];
					nextinput.focus();
					nextinput.select();
				}
			}
		}
	}
	//////////////////////////////////////////处理键盘操作///////////////////////////////////////
	//////////////////////////////////////////处理按钮事件///////////////////////////////////////
	//自动填充
var currentObj;

function showDiv(event) {
	var e = event || window.event;
	var obj = e.target || e.srcElement;
	var eX = e.clientX;
	var eY = e.clientY;
	var sY = document.body.parentNode.scrollTop;
	var dY = eY + sY;
	var divShowInput = document.getElementById("divShowInput");
	divShowInput.style.top = dY + "px";
	divShowInput.style.left = eX + "px";
	divShowInput.style.display = "block";
	hideListen();
	currentObj = obj;
	////智能菜单////
	fixMenu();
	//判断焦点位置
	var tdOrder = obj.parentNode.cellIndex;
	//填充标题标题
	var tdTitleTr = document.getElementById("tbData").getElementsByTagName("tr")[0];
	var tdTitle = tdTitleTr.getElementsByTagName("td")[tdOrder];
	document.getElementById("barTitle").innerHTML = tdTitle.innerHTML;
	//收集表格信息//判断重复
	var trs = obj.parentNode.parentNode.parentNode.getElementsByTagName("tr");
	var autoFillP = document.getElementById("autoFillP");
	var bankM = true;
	for (var i = 0; i < trs.length; i++) {
		var inputValue = trs[i].getElementsByTagName("td")[tdOrder].getElementsByTagName("input")[0].value;
		if (inputValue != "") {
			bankM = false;
			var menus = autoFillP.getElementsByTagName("a");
			if (menus.length > 0) {
				var beliveM = true;
				for (var j = 0; j < menus.length; j++) {
					if (menus[j].firstChild.nodeValue == inputValue) {
						beliveM = false;
					}
				}
				if (beliveM) {
					var Svalue = document.createElement("a");
					Svalue.setAttribute("href", "javascript:void 0");
					Svalue.onclick = function() {
						fillInput(this)
					};
					var Stext = document.createTextNode(inputValue);
					Svalue.appendChild(Stext);
					autoFillP.appendChild(Svalue);
				}
			} else {
				var Svalue = document.createElement("a");
				Svalue.setAttribute("href", "javascript:void 0");
				Svalue.onclick = function() {
					fillInput(this)
				};
				var Stext = document.createTextNode(inputValue);
				Svalue.appendChild(Stext);
				autoFillP.appendChild(Svalue);
			}
		}
	}
	if (bankM) {
		var Svalue = document.createElement("a");
		Svalue.setAttribute("href", "javascript:void 0");
		var Stext = document.createTextNode("数据空");
		Svalue.appendChild(Stext);
		autoFillP.appendChild(Svalue);
	}
}

function fillInput(obj) {
	currentObj.value = obj.innerHTML;
	divShowInput.style.display = "none";
}

function clearInput() {
	currentObj.value = "";
	divShowInput.style.display = "none";
}

function hideDiv() {
	divShowInput.style.display = "none";
	stophide();
}

function hideListen() {
	if (document.addEventListener) {
		document.addEventListener("click", hideDiv, true);
	} else {
		document.attachEvent("onclick", hideDiv);
	}
}

function stophide() {
		if (document.removeEventListener) {
			document.removeEventListener("click", keyDown, true);
		} else {
			document.detachEvent("onclick", keyDown);
		}
	}
	//删除智能菜单已有数据

function fixMenu() {
		var autoFillP = document.getElementById("autoFillP");
		var values = autoFillP.getElementsByTagName("a");
		for (var i = values.length - 1; i >= 0; i--) {
			autoFillP.removeChild(values[i]);
		}
	}
	//////////////////////////////////////////处理按钮事件///////////////////////////////////////
	//////////////////////////////////////////数据发送///////////////////////////////////////

function sendData() {
	var total = document.getElementById("total").innerHTML;
	var mps_id = document.getElementById("mpstrategy_id").value;
	//alert(total);
	if (mps_id == "") {
		alert("请选择组卷策略！");
		return
	} else if (total != 100.00) {
		alert("总分必须为100.00！");
		return
	} else {
		var mps_content = new Array();
		mps_content[0] = mps_id;
		var trs = tbody.getElementsByTagName("tr");
		for (var i = 0; i < trs.length; i++) {
			var tds = trs[i].getElementsByTagName("td");
			mps_content[i + 1] = new Array();
			for (var j = 0; j < tds.length; j++) {
				if (tds[j].firstChild.value == "") {
					alert("内容均不能为空！");
					return
				} else {
					mps_content[i + 1][j] = tds[j].firstChild.value;
				}
			}
		}
		//onsole.log(JSON.stringify(mps_content));
		post('function_handle_mps.php', JSON.stringify(mps_content));
	}
}

function post(URL, PARAMS) {
		var temp = document.createElement("form");
		temp.action = URL;
		temp.method = "post";
		temp.style.display = "none";
		var opt = document.createElement("textarea");
		opt.name = 'mps_content';
		opt.value = PARAMS;
		// alert(opt.name)
		temp.appendChild(opt);
		document.body.appendChild(temp);
		temp.submit();
		return temp;
	}
	//////////////////////////////////////////数据发送///////////////////////////////////////
	//--></SCRIPT>
		<STYLE type=text/css>
			BODY {
			/*FONT-SIZE: 12px;
			FONT-FAMILY: Arial, Helvetica, sans-serif;
			BACKGROUND-COLOR: #e9edf7*/
			}
			#tbBackground {
			BACKGROUND-COLOR: #ffffff;
			TEXT-ALIGN: center;
			}
			#tbData {
			BACKGROUND-COLOR: #dde3ec
			}
			#tbData TD {
			BACKGROUND-COLOR: #ffffff
			}
			#tbData INPUT {
			WIDTH: 50px;
			BORDER-TOP-STYLE: none;
			BORDER-RIGHT-STYLE: none;
			BORDER-LEFT-STYLE: none;
			BORDER-BOTTOM-STYLE: none
			}
			#tbData .checkbox {
			WIDTH: 15px
			}
			#tbData THEAD {
			}
			#tbTopOpt A {
			BORDER-RIGHT: #999999 1px solid;
			PADDING-RIGHT: 5px;
			BORDER-TOP: #999999 1px solid;
			DISPLAY: block;
			PADDING-LEFT: 5px;
			PADDING-BOTTOM: 5px;
			BORDER-LEFT: #999999 1px solid;
			WIDTH: 80px;
			COLOR: #000000;
			PADDING-TOP: 5px;
			BORDER-BOTTOM: #999999 1px solid;
			BACKGROUND-COLOR: #f8f9fc;
			TEXT-DECORATION: none
			}
			#tbTopOpt A:hover {
			BACKGROUND-COLOR: #dde3ec
			}
			#tbBomOpt A {
			BORDER-RIGHT: #999999 1px solid;
			PADDING-RIGHT: 5px;
			BORDER-TOP: #999999 1px solid;
			DISPLAY: block;
			PADDING-LEFT: 5px;
			PADDING-BOTTOM: 5px;
			BORDER-LEFT: #999999 1px solid;
			WIDTH: 80px;
			COLOR: #000000;
			PADDING-TOP: 5px;
			BORDER-BOTTOM: #999999 1px solid;
			BACKGROUND-COLOR: #f8f9fc;
			TEXT-DECORATION: none
			}
			#tbBomOpt A:hover {
			BACKGROUND-COLOR: #dde3ec
			}
			#tbData A {
			COLOR: #000000;
			TEXT-DECORATION: none
			}
			#divShowInput {
			BORDER-RIGHT: #dde3ec 1px solid;
			BORDER-TOP: #dde3ec 1px solid;
			DISPLAY: none;
			Z-INDEX: 10;
			LEFT: 350px;
			OVERFLOW: hidden;
			BORDER-LEFT: #dde3ec 1px solid;
			WIDTH: 100px;
			BORDER-BOTTOM: #dde3ec 1px solid;
			POSITION: absolute;
			TOP: 30px;
			BACKGROUND-COLOR: #f8f9fc
			}
			#divShowInput A {
			DISPLAY: block;
			WIDTH: auto;
			COLOR: #000000;
			BACKGROUND-COLOR: #f8f9fc;
			TEXT-ALIGN: center;
			TEXT-DECORATION: none
			}
			#divShowInput A:hover {
			BORDER-RIGHT: #ff0000 2px solid;
			BORDER-LEFT: #ff0000 2px solid;
			COLOR: #ff0000;
			BACKGROUND-COLOR: #dde3ec
			}
			#divShowInput P {
			PADDING-RIGHT: 0px;
			PADDING-LEFT: 0px;
			BORDER-BOTTOM-COLOR: #dde3ec;
			PADDING-BOTTOM: 0px;
			MARGIN: 0px;
			PADDING-TOP: 0px;
			BACKGROUND-COLOR: #f8f9fc;
			TEXT-ALIGN: center;
			BORDER-BOTTOM-STYLE: double
			}
			#divFoltupDiv {
			DISPLAY: none;
			Z-INDEX: 1001;
			RIGHT: 0px;
			FILTER: progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled=true, sizingMethod=scale, src='gb.png');
			LEFT: 0px;
			PADDING-BOTTOM: 300px;
			WIDTH: 100%;
			BOTTOM: 0px;
			PADDING-TOP: 270px;
			POSITION: absolute;
			TOP: 0px;
			TEXT-ALIGN: center
			}
			UNKNOWN {
			BACKGROUND-IMAGE: url(file:///D|/wamp/www/test/gb.png);
			BACKGROUND-REPEAT: repeat
			}
			P#sendokBiginf {
			FONT-SIZE: 20px;
			COLOR: red
			}
		</STYLE>
		<META content="MSHTML 6.00.2800.1400" name=GENERATOR>
	</HEAD>
	<BODY>
		<!--<DIV id=divFoltupDiv>
		<P><IMG alt=Loading src=""> 发送数据</P>
		<P id=sendokBiginf> </P>
		<P id=sendokinf> </P>
		</DIV>-->
		<?php $mpstrategy=getMpstrategy();
 //获取组卷策略信息
 $moduleInfor=getModule();
 //获取科目信息
 $subjectInfor=getSubject();
 //获取章节信息?>
		<form action="" method="post">
			<div class="row">
				<span class="label">
					<label>组卷策略：</label>
				</span>
				<span class="formw">
					<select style="width:150px;" name="mpstrategy_id" id="mpstrategy_id" onchange="javascript:getMPSInfor()">
						<option value="">
						</option>
						<?php $i = 0;
						$mpstrategy_id = array();
						foreach ($mpstrategy as $row) {
							$mpstrategy_id[$i] = $row['mpstrategy_id'];
							$i++;
						}
						$mpstrategy_id = array_unique($mpstrategy_id);
						foreach ($mpstrategy_id as $row) {
							echo "<option value='" . $row . "'>" . $row . "</option>";
						}
						?>
					</select>
					<!--<input type="text" name="mps_id" id="mps_id" style="display:none; width:146px;" readonly="readonly" />-->
					&nbsp;&nbsp;
					<a href="javascript:NewMPS();" id="addNewMPS">
						新建组卷策略
					</a>
					<a href="javascript:cancelNewMPS();" id="cancelAdd" style="display:none;">
						取消新建
					</a>
				</span>
			</div>
			<TABLE id=tbBackground cellSpacing=0 cellPadding=0 width=800 align=center border=0>
				<TBODY>
					<TR>
						<TD>
						</TD>
					</TR>
					<TR>
						<TD>
							<TABLE id=tbData cellSpacing=1 cellPadding=0 align=center border=0>
								<THEAD>
									<TR>
										<td rowspan="2" width="50">
											<A id=Bt_selectAll>
												全选
											</A>
										</TD>
										<td rowspan="2" width="150">
											科目
										</td>
										<td rowspan="2" width="150">
											章节
										</td>
										<td colspan="3" width="160" height="40">
											流程题
										</td>
										<td colspan="3" width="160" height="40">
											理论题
										</td>
										<td rowspan="2" width="80">
											题目挑选
										</td>
										<td rowspan="2" width="80">
											选项排列
										</td>
									</TR>
									<tr>
										<td width="45">
											数量
										</td>
										<td width="45">
											难度
										</td>
										<td width="70">
											每题分值(%)
										</td>
										<td width="45">
											数量
										</td>
										<td width="45">
											难度
										</td>
										<td width="70">
											每题分值(%)
										</td>
									</tr>
								</THEAD>
								<TBODY id='mps_items'>
									<!--<TR>
									<TD><INPUT class=checkbox type=checkbox value=checkbox name=checkbox></TD>
									<TD><INPUT name=A1></TD>
									<TD><INPUT name=A2></TD>
									<TD><INPUT name=A3></TD>
									<TD><INPUT name=A4></TD>
									<TD><INPUT name=A5></TD>
									<TD><INPUT name=A6></TD>
									<TD><INPUT name=A7></TD>
									<TD><INPUT name=A8></TD>
									<TD><INPUT name=A9></TD>
									<TD><INPUT name=A10></TD>
									</TR>-->
								</TBODY>
							</TABLE>
						</TD>
					</TR>
					<TR>
						<TD>
							<TABLE id=tbBomOpt cellSpacing=0 cellPadding=0 width=700 align=center border=0>
								<TBODY>
									<TR>
										<TD height=40>
											<A id=Bt_copySelect>
												复制所选
											</A>
										</TD>
										<TD>
											<A id=Bt_delSelect>
												删除所选
											</A>
										</TD>
										<TD>
											<A id=Bt_addTr>
												新增一行
											</A>
										</TD>
										<!--  <TD width=537><A id=Bt_allclear>清空所有</A></TD>-->
										<TD>
											<A id=Bt_sendData>
												提交
											</A>
										</TD>
										<TD>
											<A id=Back_makePaper>
												返回组卷
											</A>
										</TD>
										<TD width="61">
											总分：
										</TD>
										<TD width="40" id='total'>
											0
										</TD>
									</TR>
								</TBODY>
							</TABLE>
						</TD>
					</TR>
				</TBODY>
			</TABLE>
		</form>
	</BODY>
</HTML>
<script type="text/javascript">//////////////////////////////////////////读取组卷策略///////////////////////////////////////
function getMPSInfor() {
		var mps_id = document.getElementById("mpstrategy_id").value;
		var str = "";
		if (mps_id == "new" || mps_id == "") {} else {
			var mpsInfor =<?php echo json_encode($mpstrategy); ?>;
var num = 2;
for (var row in mpsInfor) {
	if (mpsInfor[row]['mpstrategy_id'] == mps_id) {
		str = str + "<tr>";
		str = str + "<td><input type=checkbox value='" + mpsInfor[row]['mps_item_id'] + "' name=checkbox class=checkbox /></td>";
		str = str + "<td>" + getModuleSelect(mpsInfor[row]['module_id']) + "</td>";
		str = str + "<td>" + getSubjectSelect(mpsInfor[row]['module_id'], mpsInfor[row]['subject_id']) + "</td>";
		str = str + "<td><INPUT name=A3 value='" + mpsInfor[row]['subject_flow_num'] + "' ></td>";
		str = str + "<td>" + getDiffSelect(mpsInfor[row]['subject_flow_difficulty'], 'A4') + "</td>";
		str = str + "<td><INPUT name=A5 value='" + mpsInfor[row]['subject_flow_score'] + "' ></td>";
		str = str + "<td><INPUT name=A6 value='" + mpsInfor[row]['subject_concept_num'] + "' ></td>";
		str = str + "<td>" + getDiffSelect(mpsInfor[row]['subject_concept_difficulty'], 'A7') + "</td>";
		str = str + "<td><INPUT name=A8 value='" + mpsInfor[row]['subject_concept_score'] + "' ></td>";
		str = str + "<td>" + getOrderSelect(mpsInfor[row]['subject_question_select_order'], 'A9') + "</td>";
		str = str + "<td>" + getOrderSelect(mpsInfor[row]['subject_selectoptions_order'], 'A10') + "</td>";
		str = str + "</tr>";
		num++;
	}
}
}
document.getElementById("mps_items").innerHTML = str;
getTotal();
}
//////////////////////////////////////////读取组卷策略///////////////////////////////////////
//////////////////////////////////////////获取科目选项框///////////////////////////////////////
function getModuleSelect(m_id) { //获取科目选项框
		var str = "<select id='moduleSelect' name='A1' style='width:135px;color:#999;'  onchange='get_subject()'>";
		var module =<?php echo json_encode($moduleInfor); ?>;
for (var row in module) {
	if (module[row]['module_id'] == m_id) {
		str = str + "<option selected='true' value='" + module[row]['module_id'] + "'>" + module[row]['module_name'] + "</option>";
	} else {
		str = str + "<option value='" + module[row]['module_id'] + "'>" + module[row]['module_name'] + "</option>";
	}
}
str = str + "</select>";
return str;
}
//////////////////////////////////////////获取科目选项框///////////////////////////////////////
//////////////////////////////////////////获取章节选项框///////////////////////////////////////
function getSubjectSelect(m_id, s_id) { //获取章节选项框
		var str = "<select id='subjectSelect' name='A2' style='width:135px;color:#999;'>";
		var subject_infor =<?php echo json_encode($subjectInfor); ?>;
for (var row in subject_infor) {
	if (subject_infor[row]['subject_module_id'] == m_id) {
		if (subject_infor[row]['subject_id'] == s_id) {
			str = str + "<option selected='true' value='" + subject_infor[row]['subject_id'] + "'>" + subject_infor[row]['subject_name'] + "</option>";
		} else {
			str = str + "<option value='" + subject_infor[row]['subject_id'] + "'>" + subject_infor[row]['subject_name'] + "</option>";
		}
	}
}
str = str + "</select>";
return str;
}
//////////////////////////////////////////获取章节选项框///////////////////////////////////////
//////////////////////////////////////////获取当前选中的科目所包含的章节///////////////////////////////////////
function get_subject() { //触发获取当前选中的科目所包含的章节
		var e = event || window.event;
		var obj = e.target || e.srcElement;
		obj = obj.parentNode;
		var obj_index = obj.parentNode.rowIndex;
		var select_subject = document.getElementById("tbData").rows[obj_index].cells[2].firstChild;
		var module_id = document.getElementById("tbData").rows[obj_index].cells[1].firstChild.value;
		select_subject.options.length = 0;
		subject_infor =<?php echo json_encode($subjectInfor); ?>;
for (var row in subject_infor) {
	if (subject_infor[row]['subject_module_id'] == module_id) {
		select_subject.options[select_subject.length] = new Option(subject_infor[row]['subject_name'], subject_infor[row]['subject_id']);
	}
}
}
//////////////////////////////////////////获取当前选中的科目所包含的章节///////////////////////////////////////
//////////////////////////////////////////获取难度选项框///////////////////////////////////////
function getDiffSelect(num, name) { //获取难度选项框
		var str = "<select id='diffSelect' name=" + name + " style='width:45px;color:#999;'>";
		for (var i = 1; i < 11; i++) {
			if (i == num)
				str = str + "<option selected='true' value='" + i + "'>" + i + "</option>";
			else
				str = str + "<option value='" + i + "'>" + i + "</option>";
		}
		str = str + "</select>";
		return str;
	}
	//////////////////////////////////////////获取难度选项框///////////////////////////////////////
	//////////////////////////////////////////获取顺序选项框///////////////////////////////////////

function getOrderSelect(num, name) {
		var str = "<select id='orderSelect'  name=" + name + " style='width:60px;color:#999;'>";
		if (num == 1) {
			str = str + "<option selected='true' value='1'>顺序</option>";
			str = str + "<option value='0'>随机</option>";
		} else {
			str = str + "<option value='1'>顺序</option>";
			str = str + "<option selected='true' value='0'>随机</option>";
}
str=str+"</select>";
return str;
}
//////////////////////////////////////////获取顺序选项框///////////////////////////////////////
//////////////////////////////////////////组卷策略新建或取消///////////////////////////////////////
function NewMPS()
{//新建
document.getElementById("addNewMPS").style.display="none";
document.getElementById("cancelAdd").style.display="";
var mps_select=document.getElementById("mpstrategy_id");
mps_select.options[mps_select.length]=new Option('new','new');
mps_select.options[mps_select.length-1].selected=true;
var str="<tr><td><input type=checkbox value=checkbox name='new' class=checkbox /></td>";
str=str+"<td>"+getModuleSelect('')+"</td>";
str=str+"<td>"+getSubjectSelect('','')+"</td>";
str=str+"<td><INPUT name=A3 value='' ></td>";
str=str+"<td>"+getDiffSelect('','A4')+"</td>";
str=str+"<td><INPUT name=A5 value='' ></td>";
str=str+"<td><INPUT name=A6 value='' ></td>";
str=str+"<td>"+getDiffSelect('','A7')+"</td>";
str=str+"<td><INPUT name=A8 value='' ></td>";
str=str+"<td>"+getOrderSelect('','A9')+"</td>";
str=str+"<td>"+getOrderSelect('','A10')+"</td></tr>";
document.getElementById("mps_items").innerHTML=str;
}
function cancelNewMPS()
{//取消
document.getElementById("addNewMPS").style.display="";
document.getElementById("cancelAdd").style.display="none";
var mps_select=document.getElementById("mpstrategy_id");
mps_select.length--;
mps_select.options[0].selected=true;
getMPSInfor();
}
//////////////////////////////////////////新建组卷策略///////////////////////////////////////
</script>