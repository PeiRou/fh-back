<template>
	<div class="iframe-body" style="display: block;">
		<div id="subpage" class="cp-box2" style="width: 1000px">
			<div style="padding: 5px 0px;">
				<select id="historyQueryParamGameId" onchange="History.historyDateChange()">
					<option value="80">秒速赛车</option>
					<option value="50">北京赛车(PK10)</option>
					<option value="82">秒速飞艇</option>
					<option value="81">秒速时时彩</option>
					<option value="1">重庆时时彩</option>
					<option value="84">幸运蛋蛋</option>
					<option value="70">香港六合彩</option>
					<option value="61">重庆幸运农场</option>
					<option value="85">幸运六合彩</option>
					<option value="83">幸运快乐8</option>
					<option value="66">PC蛋蛋</option>
					<option value="21">广东11选5</option>
					<option value="10">江苏骰宝(快3)</option>
					<option value="65">北京快乐8</option>
					<option value="60">广东快乐十分</option>
					<option value="4">新疆时时彩</option>
				</select>
				日期：
				    <el-date-picker
				      v-model="value2"
				      align="right"
				      type="date"
							size='mini'
				      placeholder="开奖日期">
				    </el-date-picker>
			</div>
			<table class="u-table2 play_tab_10" id="history_table">
				<thead>
					<tr>
						<th style="width:100px" rowspan="2">期数</th>
						<th style="width: 100px" rowspan="2">开奖时间</th>
						<th colspan="10">开出号码</th>
						<th colspan="3" rowspan="2">冠亚军和</th>
						<th colspan="5" rowspan="2">1~5龙虎</th>
					</tr>
					<tr>
						<th>第一名</th>
						<th>第二名</th>
						<th>第三名</th>
						<th>第四名</th>
						<th>第五名</th>
						<th>第六名</th>
						<th>第七名</th>
						<th>第八名</th>
						<th>第九名</th>
						<th>第十名</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>180206737</td>
						<td>2018-02-06 22:50:00</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206736</td>
						<td>2018-02-06 22:48:45</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206735</td>
						<td>2018-02-06 22:47:30</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206734</td>
						<td>2018-02-06 22:46:15</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>6</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206733</td>
						<td>2018-02-06 22:45:00</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206732</td>
						<td>2018-02-06 22:43:45</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>17</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206731</td>
						<td>2018-02-06 22:42:30</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206730</td>
						<td>2018-02-06 22:41:15</td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>17</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206729</td>
						<td>2018-02-06 22:40:00</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206728</td>
						<td>2018-02-06 22:38:45</td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>17</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206727</td>
						<td>2018-02-06 22:37:30</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206726</td>
						<td>2018-02-06 22:36:15</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206725</td>
						<td>2018-02-06 22:35:00</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206724</td>
						<td>2018-02-06 22:33:45</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>6</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206723</td>
						<td>2018-02-06 22:32:30</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206722</td>
						<td>2018-02-06 22:31:15</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>6</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206721</td>
						<td>2018-02-06 22:30:00</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206720</td>
						<td>2018-02-06 22:28:45</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>5</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206719</td>
						<td>2018-02-06 22:27:30</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206718</td>
						<td>2018-02-06 22:26:15</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206717</td>
						<td>2018-02-06 22:25:00</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206716</td>
						<td>2018-02-06 22:23:45</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206715</td>
						<td>2018-02-06 22:22:30</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>3</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206714</td>
						<td>2018-02-06 22:21:15</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206713</td>
						<td>2018-02-06 22:20:00</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206712</td>
						<td>2018-02-06 22:18:45</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206711</td>
						<td>2018-02-06 22:17:30</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206710</td>
						<td>2018-02-06 22:16:15</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>8</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206709</td>
						<td>2018-02-06 22:15:00</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206708</td>
						<td>2018-02-06 22:13:45</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>4</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206707</td>
						<td>2018-02-06 22:12:30</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206706</td>
						<td>2018-02-06 22:11:15</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206705</td>
						<td>2018-02-06 22:10:00</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>17</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206704</td>
						<td>2018-02-06 22:08:45</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206703</td>
						<td>2018-02-06 22:07:30</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206702</td>
						<td>2018-02-06 22:06:15</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>8</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206701</td>
						<td>2018-02-06 22:05:00</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>19</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206700</td>
						<td>2018-02-06 22:03:45</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206699</td>
						<td>2018-02-06 22:02:30</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>17</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206698</td>
						<td>2018-02-06 22:01:15</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206697</td>
						<td>2018-02-06 22:00:00</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206696</td>
						<td>2018-02-06 21:58:45</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206695</td>
						<td>2018-02-06 21:57:30</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>15</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206694</td>
						<td>2018-02-06 21:56:15</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206693</td>
						<td>2018-02-06 21:55:00</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206692</td>
						<td>2018-02-06 21:53:45</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206691</td>
						<td>2018-02-06 21:52:30</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206690</td>
						<td>2018-02-06 21:51:15</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206689</td>
						<td>2018-02-06 21:50:00</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>6</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206688</td>
						<td>2018-02-06 21:48:45</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>17</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206687</td>
						<td>2018-02-06 21:47:30</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206686</td>
						<td>2018-02-06 21:46:15</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>14</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206685</td>
						<td>2018-02-06 21:45:00</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>6</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206684</td>
						<td>2018-02-06 21:43:45</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206683</td>
						<td>2018-02-06 21:42:30</td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>15</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206682</td>
						<td>2018-02-06 21:41:15</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>17</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206681</td>
						<td>2018-02-06 21:40:00</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206680</td>
						<td>2018-02-06 21:38:45</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206679</td>
						<td>2018-02-06 21:37:30</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206678</td>
						<td>2018-02-06 21:36:15</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>14</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206677</td>
						<td>2018-02-06 21:35:00</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206676</td>
						<td>2018-02-06 21:33:45</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206675</td>
						<td>2018-02-06 21:32:30</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206674</td>
						<td>2018-02-06 21:31:15</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>14</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206673</td>
						<td>2018-02-06 21:30:00</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206672</td>
						<td>2018-02-06 21:28:45</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206671</td>
						<td>2018-02-06 21:27:30</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206670</td>
						<td>2018-02-06 21:26:15</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206669</td>
						<td>2018-02-06 21:25:00</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206668</td>
						<td>2018-02-06 21:23:45</td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206667</td>
						<td>2018-02-06 21:22:30</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>14</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206666</td>
						<td>2018-02-06 21:21:15</td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206665</td>
						<td>2018-02-06 21:20:00</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206664</td>
						<td>2018-02-06 21:18:45</td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>14</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206663</td>
						<td>2018-02-06 21:17:30</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>5</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206662</td>
						<td>2018-02-06 21:16:15</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206661</td>
						<td>2018-02-06 21:15:00</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206660</td>
						<td>2018-02-06 21:13:45</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206659</td>
						<td>2018-02-06 21:12:30</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206658</td>
						<td>2018-02-06 21:11:15</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>3</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206657</td>
						<td>2018-02-06 21:10:00</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>14</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206656</td>
						<td>2018-02-06 21:08:45</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206655</td>
						<td>2018-02-06 21:07:30</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206654</td>
						<td>2018-02-06 21:06:15</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>17</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206653</td>
						<td>2018-02-06 21:05:00</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>4</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206652</td>
						<td>2018-02-06 21:03:45</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206651</td>
						<td>2018-02-06 21:02:30</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206650</td>
						<td>2018-02-06 21:01:15</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>18</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206649</td>
						<td>2018-02-06 21:00:00</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206648</td>
						<td>2018-02-06 20:58:45</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>15</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206647</td>
						<td>2018-02-06 20:57:30</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206646</td>
						<td>2018-02-06 20:56:15</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206645</td>
						<td>2018-02-06 20:55:00</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206644</td>
						<td>2018-02-06 20:53:45</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206643</td>
						<td>2018-02-06 20:52:30</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206642</td>
						<td>2018-02-06 20:51:15</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206641</td>
						<td>2018-02-06 20:50:00</td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206640</td>
						<td>2018-02-06 20:48:45</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206639</td>
						<td>2018-02-06 20:47:30</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>3</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206638</td>
						<td>2018-02-06 20:46:15</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206637</td>
						<td>2018-02-06 20:45:00</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>6</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206636</td>
						<td>2018-02-06 20:43:45</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>3</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206635</td>
						<td>2018-02-06 20:42:30</td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>18</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206634</td>
						<td>2018-02-06 20:41:15</td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>14</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206633</td>
						<td>2018-02-06 20:40:00</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206632</td>
						<td>2018-02-06 20:38:45</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206631</td>
						<td>2018-02-06 20:37:30</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206630</td>
						<td>2018-02-06 20:36:15</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>15</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206629</td>
						<td>2018-02-06 20:35:00</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206628</td>
						<td>2018-02-06 20:33:45</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206627</td>
						<td>2018-02-06 20:32:30</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>8</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206626</td>
						<td>2018-02-06 20:31:15</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>15</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206625</td>
						<td>2018-02-06 20:30:00</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206624</td>
						<td>2018-02-06 20:28:45</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>8</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206623</td>
						<td>2018-02-06 20:27:30</td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>15</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206622</td>
						<td>2018-02-06 20:26:15</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206621</td>
						<td>2018-02-06 20:25:00</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>16</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206620</td>
						<td>2018-02-06 20:23:45</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206619</td>
						<td>2018-02-06 20:22:30</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>15</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206618</td>
						<td>2018-02-06 20:21:15</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206617</td>
						<td>2018-02-06 20:20:00</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206616</td>
						<td>2018-02-06 20:18:45</td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>15</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206615</td>
						<td>2018-02-06 20:17:30</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>5</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206614</td>
						<td>2018-02-06 20:16:15</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206613</td>
						<td>2018-02-06 20:15:00</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>8</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206612</td>
						<td>2018-02-06 20:13:45</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>3</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206611</td>
						<td>2018-02-06 20:12:30</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206610</td>
						<td>2018-02-06 20:11:15</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206609</td>
						<td>2018-02-06 20:10:00</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>17</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206608</td>
						<td>2018-02-06 20:08:45</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206607</td>
						<td>2018-02-06 20:07:30</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>15</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206606</td>
						<td>2018-02-06 20:06:15</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>6</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206605</td>
						<td>2018-02-06 20:05:00</td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>14</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206604</td>
						<td>2018-02-06 20:03:45</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>17</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206603</td>
						<td>2018-02-06 20:02:30</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>8</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206602</td>
						<td>2018-02-06 20:01:15</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206601</td>
						<td>2018-02-06 20:00:00</td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>17</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206600</td>
						<td>2018-02-06 19:58:45</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206599</td>
						<td>2018-02-06 19:57:30</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206598</td>
						<td>2018-02-06 19:56:15</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>15</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206597</td>
						<td>2018-02-06 19:55:00</td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>17</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206596</td>
						<td>2018-02-06 19:53:45</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206595</td>
						<td>2018-02-06 19:52:30</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206594</td>
						<td>2018-02-06 19:51:15</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>8</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206593</td>
						<td>2018-02-06 19:50:00</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206592</td>
						<td>2018-02-06 19:48:45</td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>18</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206591</td>
						<td>2018-02-06 19:47:30</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>6</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206590</td>
						<td>2018-02-06 19:46:15</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206589</td>
						<td>2018-02-06 19:45:00</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>5</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206588</td>
						<td>2018-02-06 19:43:45</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206587</td>
						<td>2018-02-06 19:42:30</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>5</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206586</td>
						<td>2018-02-06 19:41:15</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206585</td>
						<td>2018-02-06 19:40:00</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>16</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206584</td>
						<td>2018-02-06 19:38:45</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206583</td>
						<td>2018-02-06 19:37:30</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>3</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206582</td>
						<td>2018-02-06 19:36:15</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206581</td>
						<td>2018-02-06 19:35:00</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206580</td>
						<td>2018-02-06 19:33:45</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206579</td>
						<td>2018-02-06 19:32:30</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206578</td>
						<td>2018-02-06 19:31:15</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206577</td>
						<td>2018-02-06 19:30:00</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>8</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206576</td>
						<td>2018-02-06 19:28:45</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>3</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206575</td>
						<td>2018-02-06 19:27:30</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206574</td>
						<td>2018-02-06 19:26:15</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206573</td>
						<td>2018-02-06 19:25:00</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206572</td>
						<td>2018-02-06 19:23:45</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>16</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206571</td>
						<td>2018-02-06 19:22:30</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>16</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206570</td>
						<td>2018-02-06 19:21:15</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>8</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206569</td>
						<td>2018-02-06 19:20:00</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>14</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206568</td>
						<td>2018-02-06 19:18:45</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206567</td>
						<td>2018-02-06 19:17:30</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>5</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206566</td>
						<td>2018-02-06 19:16:15</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206565</td>
						<td>2018-02-06 19:15:00</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>14</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206564</td>
						<td>2018-02-06 19:13:45</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>8</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206563</td>
						<td>2018-02-06 19:12:30</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206562</td>
						<td>2018-02-06 19:11:15</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206561</td>
						<td>2018-02-06 19:10:00</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>15</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206560</td>
						<td>2018-02-06 19:08:45</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>18</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206559</td>
						<td>2018-02-06 19:07:30</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206558</td>
						<td>2018-02-06 19:06:15</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206557</td>
						<td>2018-02-06 19:05:00</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>14</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206556</td>
						<td>2018-02-06 19:03:45</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206555</td>
						<td>2018-02-06 19:02:30</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206554</td>
						<td>2018-02-06 19:01:15</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206553</td>
						<td>2018-02-06 19:00:00</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206552</td>
						<td>2018-02-06 18:58:45</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>16</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206551</td>
						<td>2018-02-06 18:57:30</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>14</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206550</td>
						<td>2018-02-06 18:56:15</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>6</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206549</td>
						<td>2018-02-06 18:55:00</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>8</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206548</td>
						<td>2018-02-06 18:53:45</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206547</td>
						<td>2018-02-06 18:52:30</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>8</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206546</td>
						<td>2018-02-06 18:51:15</td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>17</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206545</td>
						<td>2018-02-06 18:50:00</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>14</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206544</td>
						<td>2018-02-06 18:48:45</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>15</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206543</td>
						<td>2018-02-06 18:47:30</td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>14</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206542</td>
						<td>2018-02-06 18:46:15</td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>15</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206541</td>
						<td>2018-02-06 18:45:00</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>8</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206540</td>
						<td>2018-02-06 18:43:45</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206539</td>
						<td>2018-02-06 18:42:30</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206538</td>
						<td>2018-02-06 18:41:15</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>18</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206537</td>
						<td>2018-02-06 18:40:00</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206536</td>
						<td>2018-02-06 18:38:45</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206535</td>
						<td>2018-02-06 18:37:30</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>4</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206534</td>
						<td>2018-02-06 18:36:15</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>8</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206533</td>
						<td>2018-02-06 18:35:00</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>14</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206532</td>
						<td>2018-02-06 18:33:45</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>18</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206531</td>
						<td>2018-02-06 18:32:30</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206530</td>
						<td>2018-02-06 18:31:15</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>15</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206529</td>
						<td>2018-02-06 18:30:00</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206528</td>
						<td>2018-02-06 18:28:45</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206527</td>
						<td>2018-02-06 18:27:30</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206526</td>
						<td>2018-02-06 18:26:15</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206525</td>
						<td>2018-02-06 18:25:00</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206524</td>
						<td>2018-02-06 18:23:45</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206523</td>
						<td>2018-02-06 18:22:30</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206522</td>
						<td>2018-02-06 18:21:15</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206521</td>
						<td>2018-02-06 18:20:00</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>19</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206520</td>
						<td>2018-02-06 18:18:45</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206519</td>
						<td>2018-02-06 18:17:30</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206518</td>
						<td>2018-02-06 18:16:15</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206517</td>
						<td>2018-02-06 18:15:00</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>15</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206516</td>
						<td>2018-02-06 18:13:45</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206515</td>
						<td>2018-02-06 18:12:30</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206514</td>
						<td>2018-02-06 18:11:15</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206513</td>
						<td>2018-02-06 18:10:00</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>15</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206512</td>
						<td>2018-02-06 18:08:45</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>8</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206511</td>
						<td>2018-02-06 18:07:30</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206510</td>
						<td>2018-02-06 18:06:15</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206509</td>
						<td>2018-02-06 18:05:00</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>8</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206508</td>
						<td>2018-02-06 18:03:45</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206507</td>
						<td>2018-02-06 18:02:30</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206506</td>
						<td>2018-02-06 18:01:15</td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206505</td>
						<td>2018-02-06 18:00:00</td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206504</td>
						<td>2018-02-06 17:58:45</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206503</td>
						<td>2018-02-06 17:57:30</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206502</td>
						<td>2018-02-06 17:56:15</td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>15</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206501</td>
						<td>2018-02-06 17:55:00</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>17</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206500</td>
						<td>2018-02-06 17:53:45</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>5</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206499</td>
						<td>2018-02-06 17:52:30</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206498</td>
						<td>2018-02-06 17:51:15</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>14</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206497</td>
						<td>2018-02-06 17:50:00</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206496</td>
						<td>2018-02-06 17:48:45</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>8</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206495</td>
						<td>2018-02-06 17:47:30</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>16</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206494</td>
						<td>2018-02-06 17:46:15</td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>19</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206493</td>
						<td>2018-02-06 17:45:00</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>8</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206492</td>
						<td>2018-02-06 17:43:45</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>5</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206491</td>
						<td>2018-02-06 17:42:30</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206490</td>
						<td>2018-02-06 17:41:15</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206489</td>
						<td>2018-02-06 17:40:00</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>15</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206488</td>
						<td>2018-02-06 17:38:45</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>15</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206487</td>
						<td>2018-02-06 17:37:30</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206486</td>
						<td>2018-02-06 17:36:15</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>15</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206485</td>
						<td>2018-02-06 17:35:00</td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>17</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206484</td>
						<td>2018-02-06 17:33:45</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206483</td>
						<td>2018-02-06 17:32:30</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206482</td>
						<td>2018-02-06 17:31:15</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>8</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206481</td>
						<td>2018-02-06 17:30:00</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206480</td>
						<td>2018-02-06 17:28:45</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206479</td>
						<td>2018-02-06 17:27:30</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206478</td>
						<td>2018-02-06 17:26:15</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>6</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206477</td>
						<td>2018-02-06 17:25:00</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206476</td>
						<td>2018-02-06 17:23:45</td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>18</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206475</td>
						<td>2018-02-06 17:22:30</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>3</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206474</td>
						<td>2018-02-06 17:21:15</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206473</td>
						<td>2018-02-06 17:20:00</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206472</td>
						<td>2018-02-06 17:18:45</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206471</td>
						<td>2018-02-06 17:17:30</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206470</td>
						<td>2018-02-06 17:16:15</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>19</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206469</td>
						<td>2018-02-06 17:15:00</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206468</td>
						<td>2018-02-06 17:13:45</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206467</td>
						<td>2018-02-06 17:12:30</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>6</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206466</td>
						<td>2018-02-06 17:11:15</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>8</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206465</td>
						<td>2018-02-06 17:10:00</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206464</td>
						<td>2018-02-06 17:08:45</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206463</td>
						<td>2018-02-06 17:07:30</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206462</td>
						<td>2018-02-06 17:06:15</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206461</td>
						<td>2018-02-06 17:05:00</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206460</td>
						<td>2018-02-06 17:03:45</td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206459</td>
						<td>2018-02-06 17:02:30</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206458</td>
						<td>2018-02-06 17:01:15</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>4</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206457</td>
						<td>2018-02-06 17:00:00</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206456</td>
						<td>2018-02-06 16:58:45</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>14</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206455</td>
						<td>2018-02-06 16:57:30</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206454</td>
						<td>2018-02-06 16:56:15</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206453</td>
						<td>2018-02-06 16:55:00</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206452</td>
						<td>2018-02-06 16:53:45</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>5</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206451</td>
						<td>2018-02-06 16:52:30</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>6</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206450</td>
						<td>2018-02-06 16:51:15</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206449</td>
						<td>2018-02-06 16:50:00</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206448</td>
						<td>2018-02-06 16:48:45</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206447</td>
						<td>2018-02-06 16:47:30</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>6</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206446</td>
						<td>2018-02-06 16:46:15</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>17</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206445</td>
						<td>2018-02-06 16:45:00</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>17</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206444</td>
						<td>2018-02-06 16:43:45</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>8</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206443</td>
						<td>2018-02-06 16:42:30</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>6</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206442</td>
						<td>2018-02-06 16:41:15</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206441</td>
						<td>2018-02-06 16:40:00</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206440</td>
						<td>2018-02-06 16:38:45</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206439</td>
						<td>2018-02-06 16:37:30</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206438</td>
						<td>2018-02-06 16:36:15</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>15</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206437</td>
						<td>2018-02-06 16:35:00</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206436</td>
						<td>2018-02-06 16:33:45</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>6</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206435</td>
						<td>2018-02-06 16:32:30</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>8</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206434</td>
						<td>2018-02-06 16:31:15</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206433</td>
						<td>2018-02-06 16:30:00</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206432</td>
						<td>2018-02-06 16:28:45</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206431</td>
						<td>2018-02-06 16:27:30</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206430</td>
						<td>2018-02-06 16:26:15</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>6</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206429</td>
						<td>2018-02-06 16:25:00</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206428</td>
						<td>2018-02-06 16:23:45</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206427</td>
						<td>2018-02-06 16:22:30</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>15</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206426</td>
						<td>2018-02-06 16:21:15</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>5</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206425</td>
						<td>2018-02-06 16:20:00</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>17</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206424</td>
						<td>2018-02-06 16:18:45</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>5</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206423</td>
						<td>2018-02-06 16:17:30</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206422</td>
						<td>2018-02-06 16:16:15</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>8</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206421</td>
						<td>2018-02-06 16:15:00</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206420</td>
						<td>2018-02-06 16:13:45</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206419</td>
						<td>2018-02-06 16:12:30</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206418</td>
						<td>2018-02-06 16:11:15</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>14</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206417</td>
						<td>2018-02-06 16:10:00</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>16</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206416</td>
						<td>2018-02-06 16:08:45</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>4</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206415</td>
						<td>2018-02-06 16:07:30</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>6</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206414</td>
						<td>2018-02-06 16:06:15</td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>14</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206413</td>
						<td>2018-02-06 16:05:00</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206412</td>
						<td>2018-02-06 16:03:45</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>17</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206411</td>
						<td>2018-02-06 16:02:30</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>3</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206410</td>
						<td>2018-02-06 16:01:15</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206409</td>
						<td>2018-02-06 16:00:00</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>14</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206408</td>
						<td>2018-02-06 15:58:45</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>16</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206407</td>
						<td>2018-02-06 15:57:30</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206406</td>
						<td>2018-02-06 15:56:15</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206405</td>
						<td>2018-02-06 15:55:00</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206404</td>
						<td>2018-02-06 15:53:45</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>17</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206403</td>
						<td>2018-02-06 15:52:30</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206402</td>
						<td>2018-02-06 15:51:15</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206401</td>
						<td>2018-02-06 15:50:00</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206400</td>
						<td>2018-02-06 15:48:45</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206399</td>
						<td>2018-02-06 15:47:30</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206398</td>
						<td>2018-02-06 15:46:15</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>8</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206397</td>
						<td>2018-02-06 15:45:00</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>16</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206396</td>
						<td>2018-02-06 15:43:45</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206395</td>
						<td>2018-02-06 15:42:30</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206394</td>
						<td>2018-02-06 15:41:15</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206393</td>
						<td>2018-02-06 15:40:00</td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>15</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206392</td>
						<td>2018-02-06 15:38:45</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206391</td>
						<td>2018-02-06 15:37:30</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206390</td>
						<td>2018-02-06 15:36:15</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206389</td>
						<td>2018-02-06 15:35:00</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>14</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206388</td>
						<td>2018-02-06 15:33:45</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206387</td>
						<td>2018-02-06 15:32:30</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>6</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206386</td>
						<td>2018-02-06 15:31:15</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206385</td>
						<td>2018-02-06 15:30:00</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>3</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206384</td>
						<td>2018-02-06 15:28:45</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206383</td>
						<td>2018-02-06 15:27:30</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>16</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206382</td>
						<td>2018-02-06 15:26:15</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206381</td>
						<td>2018-02-06 15:25:00</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206380</td>
						<td>2018-02-06 15:23:45</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>15</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206379</td>
						<td>2018-02-06 15:22:30</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206378</td>
						<td>2018-02-06 15:21:15</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206377</td>
						<td>2018-02-06 15:20:00</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206376</td>
						<td>2018-02-06 15:18:45</td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206375</td>
						<td>2018-02-06 15:17:30</td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>17</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206374</td>
						<td>2018-02-06 15:16:15</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>6</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206373</td>
						<td>2018-02-06 15:15:00</td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206372</td>
						<td>2018-02-06 15:13:45</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206371</td>
						<td>2018-02-06 15:12:30</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>6</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206370</td>
						<td>2018-02-06 15:11:15</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206369</td>
						<td>2018-02-06 15:10:00</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>5</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206368</td>
						<td>2018-02-06 15:08:45</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>14</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206367</td>
						<td>2018-02-06 15:07:30</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206366</td>
						<td>2018-02-06 15:06:15</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206365</td>
						<td>2018-02-06 15:05:00</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>17</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206364</td>
						<td>2018-02-06 15:03:45</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206363</td>
						<td>2018-02-06 15:02:30</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206362</td>
						<td>2018-02-06 15:01:15</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206361</td>
						<td>2018-02-06 15:00:00</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>16</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206360</td>
						<td>2018-02-06 14:58:45</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>15</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206359</td>
						<td>2018-02-06 14:57:30</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>19</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206358</td>
						<td>2018-02-06 14:56:15</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206357</td>
						<td>2018-02-06 14:55:00</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206356</td>
						<td>2018-02-06 14:53:45</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>17</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206355</td>
						<td>2018-02-06 14:52:30</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>8</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206354</td>
						<td>2018-02-06 14:51:15</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>6</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206353</td>
						<td>2018-02-06 14:50:00</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>15</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206352</td>
						<td>2018-02-06 14:48:45</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>6</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206351</td>
						<td>2018-02-06 14:47:30</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206350</td>
						<td>2018-02-06 14:46:15</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>14</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206349</td>
						<td>2018-02-06 14:45:00</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206348</td>
						<td>2018-02-06 14:43:45</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206347</td>
						<td>2018-02-06 14:42:30</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>5</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206346</td>
						<td>2018-02-06 14:41:15</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>6</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206345</td>
						<td>2018-02-06 14:40:00</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206344</td>
						<td>2018-02-06 14:38:45</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206343</td>
						<td>2018-02-06 14:37:30</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>15</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206342</td>
						<td>2018-02-06 14:36:15</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>14</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206341</td>
						<td>2018-02-06 14:35:00</td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>18</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206340</td>
						<td>2018-02-06 14:33:45</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206339</td>
						<td>2018-02-06 14:32:30</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>15</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206338</td>
						<td>2018-02-06 14:31:15</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206337</td>
						<td>2018-02-06 14:30:00</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206336</td>
						<td>2018-02-06 14:28:45</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>16</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206335</td>
						<td>2018-02-06 14:27:30</td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>14</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206334</td>
						<td>2018-02-06 14:26:15</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206333</td>
						<td>2018-02-06 14:25:00</td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>18</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206332</td>
						<td>2018-02-06 14:23:45</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206331</td>
						<td>2018-02-06 14:22:30</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206330</td>
						<td>2018-02-06 14:21:15</td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>19</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206329</td>
						<td>2018-02-06 14:20:00</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206328</td>
						<td>2018-02-06 14:18:45</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>17</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206327</td>
						<td>2018-02-06 14:17:30</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>5</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206326</td>
						<td>2018-02-06 14:16:15</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206325</td>
						<td>2018-02-06 14:15:00</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206324</td>
						<td>2018-02-06 14:13:45</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206323</td>
						<td>2018-02-06 14:12:30</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>18</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206322</td>
						<td>2018-02-06 14:11:15</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>15</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206321</td>
						<td>2018-02-06 14:10:00</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206320</td>
						<td>2018-02-06 14:08:45</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206319</td>
						<td>2018-02-06 14:07:30</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206318</td>
						<td>2018-02-06 14:06:15</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206317</td>
						<td>2018-02-06 14:05:00</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>5</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206316</td>
						<td>2018-02-06 14:03:45</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206315</td>
						<td>2018-02-06 14:02:30</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206314</td>
						<td>2018-02-06 14:01:15</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206313</td>
						<td>2018-02-06 14:00:00</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>14</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206312</td>
						<td>2018-02-06 13:58:45</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206311</td>
						<td>2018-02-06 13:57:30</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206310</td>
						<td>2018-02-06 13:56:15</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206309</td>
						<td>2018-02-06 13:55:00</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206308</td>
						<td>2018-02-06 13:53:45</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206307</td>
						<td>2018-02-06 13:52:30</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206306</td>
						<td>2018-02-06 13:51:15</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>14</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206305</td>
						<td>2018-02-06 13:50:00</td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>17</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206304</td>
						<td>2018-02-06 13:48:45</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>6</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206303</td>
						<td>2018-02-06 13:47:30</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206302</td>
						<td>2018-02-06 13:46:15</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>18</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206301</td>
						<td>2018-02-06 13:45:00</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>6</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206300</td>
						<td>2018-02-06 13:43:45</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>8</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206299</td>
						<td>2018-02-06 13:42:30</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206298</td>
						<td>2018-02-06 13:41:15</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>15</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206297</td>
						<td>2018-02-06 13:40:00</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206296</td>
						<td>2018-02-06 13:38:45</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206295</td>
						<td>2018-02-06 13:37:30</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206294</td>
						<td>2018-02-06 13:36:15</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>8</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206293</td>
						<td>2018-02-06 13:35:00</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>15</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206292</td>
						<td>2018-02-06 13:33:45</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>17</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206291</td>
						<td>2018-02-06 13:32:30</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>5</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206290</td>
						<td>2018-02-06 13:31:15</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>8</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206289</td>
						<td>2018-02-06 13:30:00</td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>16</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206288</td>
						<td>2018-02-06 13:28:45</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206287</td>
						<td>2018-02-06 13:27:30</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>17</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206286</td>
						<td>2018-02-06 13:26:15</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206285</td>
						<td>2018-02-06 13:25:00</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206284</td>
						<td>2018-02-06 13:23:45</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>16</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206283</td>
						<td>2018-02-06 13:22:30</td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>17</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206282</td>
						<td>2018-02-06 13:21:15</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206281</td>
						<td>2018-02-06 13:20:00</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206280</td>
						<td>2018-02-06 13:18:45</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206279</td>
						<td>2018-02-06 13:17:30</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206278</td>
						<td>2018-02-06 13:16:15</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206277</td>
						<td>2018-02-06 13:15:00</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206276</td>
						<td>2018-02-06 13:13:45</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206275</td>
						<td>2018-02-06 13:12:30</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>16</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206274</td>
						<td>2018-02-06 13:11:15</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>17</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206273</td>
						<td>2018-02-06 13:10:00</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206272</td>
						<td>2018-02-06 13:08:45</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>16</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206271</td>
						<td>2018-02-06 13:07:30</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>15</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206270</td>
						<td>2018-02-06 13:06:15</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206269</td>
						<td>2018-02-06 13:05:00</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>3</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206268</td>
						<td>2018-02-06 13:03:45</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206267</td>
						<td>2018-02-06 13:02:30</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>8</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206266</td>
						<td>2018-02-06 13:01:15</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>14</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206265</td>
						<td>2018-02-06 13:00:00</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>19</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206264</td>
						<td>2018-02-06 12:58:45</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206263</td>
						<td>2018-02-06 12:57:30</td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>19</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206262</td>
						<td>2018-02-06 12:56:15</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206261</td>
						<td>2018-02-06 12:55:00</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>5</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206260</td>
						<td>2018-02-06 12:53:45</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206259</td>
						<td>2018-02-06 12:52:30</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206258</td>
						<td>2018-02-06 12:51:15</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206257</td>
						<td>2018-02-06 12:50:00</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206256</td>
						<td>2018-02-06 12:48:45</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206255</td>
						<td>2018-02-06 12:47:30</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206254</td>
						<td>2018-02-06 12:46:15</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206253</td>
						<td>2018-02-06 12:45:00</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206252</td>
						<td>2018-02-06 12:43:45</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>8</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206251</td>
						<td>2018-02-06 12:42:30</td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>17</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206250</td>
						<td>2018-02-06 12:41:15</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206249</td>
						<td>2018-02-06 12:40:00</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>5</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206248</td>
						<td>2018-02-06 12:38:45</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206247</td>
						<td>2018-02-06 12:37:30</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>5</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206246</td>
						<td>2018-02-06 12:36:15</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>19</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206245</td>
						<td>2018-02-06 12:35:00</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206244</td>
						<td>2018-02-06 12:33:45</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>8</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206243</td>
						<td>2018-02-06 12:32:30</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>6</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206242</td>
						<td>2018-02-06 12:31:15</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206241</td>
						<td>2018-02-06 12:30:00</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206240</td>
						<td>2018-02-06 12:28:45</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206239</td>
						<td>2018-02-06 12:27:30</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>15</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206238</td>
						<td>2018-02-06 12:26:15</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206237</td>
						<td>2018-02-06 12:25:00</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206236</td>
						<td>2018-02-06 12:23:45</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>8</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206235</td>
						<td>2018-02-06 12:22:30</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>4</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206234</td>
						<td>2018-02-06 12:21:15</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>15</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206233</td>
						<td>2018-02-06 12:20:00</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>16</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206232</td>
						<td>2018-02-06 12:18:45</td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206231</td>
						<td>2018-02-06 12:17:30</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206230</td>
						<td>2018-02-06 12:16:15</td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>14</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206229</td>
						<td>2018-02-06 12:15:00</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206228</td>
						<td>2018-02-06 12:13:45</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>8</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206227</td>
						<td>2018-02-06 12:12:30</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206226</td>
						<td>2018-02-06 12:11:15</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>6</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206225</td>
						<td>2018-02-06 12:10:00</td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>14</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206224</td>
						<td>2018-02-06 12:08:45</td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206223</td>
						<td>2018-02-06 12:07:30</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>8</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206222</td>
						<td>2018-02-06 12:06:15</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206221</td>
						<td>2018-02-06 12:05:00</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>16</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206220</td>
						<td>2018-02-06 12:03:45</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>16</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206219</td>
						<td>2018-02-06 12:02:30</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206218</td>
						<td>2018-02-06 12:01:15</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>15</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206217</td>
						<td>2018-02-06 12:00:00</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>14</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206216</td>
						<td>2018-02-06 11:58:45</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206215</td>
						<td>2018-02-06 11:57:30</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206214</td>
						<td>2018-02-06 11:56:15</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>15</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206213</td>
						<td>2018-02-06 11:55:00</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>6</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206212</td>
						<td>2018-02-06 11:53:45</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>8</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206211</td>
						<td>2018-02-06 11:52:30</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>18</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206210</td>
						<td>2018-02-06 11:51:15</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206209</td>
						<td>2018-02-06 11:50:00</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>5</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206208</td>
						<td>2018-02-06 11:48:45</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>15</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206207</td>
						<td>2018-02-06 11:47:30</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>8</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206206</td>
						<td>2018-02-06 11:46:15</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>15</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206205</td>
						<td>2018-02-06 11:45:00</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>14</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206204</td>
						<td>2018-02-06 11:43:45</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206203</td>
						<td>2018-02-06 11:42:30</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206202</td>
						<td>2018-02-06 11:41:15</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206201</td>
						<td>2018-02-06 11:40:00</td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>19</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206200</td>
						<td>2018-02-06 11:38:45</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>14</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206199</td>
						<td>2018-02-06 11:37:30</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>4</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206198</td>
						<td>2018-02-06 11:36:15</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>16</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206197</td>
						<td>2018-02-06 11:35:00</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206196</td>
						<td>2018-02-06 11:33:45</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>15</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206195</td>
						<td>2018-02-06 11:32:30</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>16</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206194</td>
						<td>2018-02-06 11:31:15</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206193</td>
						<td>2018-02-06 11:30:00</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206192</td>
						<td>2018-02-06 11:28:45</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206191</td>
						<td>2018-02-06 11:27:30</td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>18</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206190</td>
						<td>2018-02-06 11:26:15</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>14</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206189</td>
						<td>2018-02-06 11:25:00</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206188</td>
						<td>2018-02-06 11:23:45</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206187</td>
						<td>2018-02-06 11:22:30</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>4</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206186</td>
						<td>2018-02-06 11:21:15</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206185</td>
						<td>2018-02-06 11:20:00</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>4</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206184</td>
						<td>2018-02-06 11:18:45</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>17</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206183</td>
						<td>2018-02-06 11:17:30</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>16</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206182</td>
						<td>2018-02-06 11:16:15</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>6</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206181</td>
						<td>2018-02-06 11:15:00</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>14</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206180</td>
						<td>2018-02-06 11:13:45</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206179</td>
						<td>2018-02-06 11:12:30</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>15</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206178</td>
						<td>2018-02-06 11:11:15</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>15</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206177</td>
						<td>2018-02-06 11:10:00</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>8</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206176</td>
						<td>2018-02-06 11:08:45</td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>17</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206175</td>
						<td>2018-02-06 11:07:30</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>5</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206174</td>
						<td>2018-02-06 11:06:15</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>15</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206173</td>
						<td>2018-02-06 11:05:00</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206172</td>
						<td>2018-02-06 11:03:45</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206171</td>
						<td>2018-02-06 11:02:30</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206170</td>
						<td>2018-02-06 11:01:15</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>3</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206169</td>
						<td>2018-02-06 11:00:00</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206168</td>
						<td>2018-02-06 10:58:45</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206167</td>
						<td>2018-02-06 10:57:30</td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>17</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206166</td>
						<td>2018-02-06 10:56:15</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>16</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206165</td>
						<td>2018-02-06 10:55:00</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206164</td>
						<td>2018-02-06 10:53:45</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>8</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206163</td>
						<td>2018-02-06 10:52:30</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206162</td>
						<td>2018-02-06 10:51:15</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>17</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206161</td>
						<td>2018-02-06 10:50:00</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206160</td>
						<td>2018-02-06 10:48:45</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206159</td>
						<td>2018-02-06 10:47:30</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206158</td>
						<td>2018-02-06 10:46:15</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>8</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206157</td>
						<td>2018-02-06 10:45:00</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206156</td>
						<td>2018-02-06 10:43:45</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206155</td>
						<td>2018-02-06 10:42:30</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206154</td>
						<td>2018-02-06 10:41:15</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206153</td>
						<td>2018-02-06 10:40:00</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206152</td>
						<td>2018-02-06 10:38:45</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206151</td>
						<td>2018-02-06 10:37:30</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206150</td>
						<td>2018-02-06 10:36:15</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206149</td>
						<td>2018-02-06 10:35:00</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>14</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206148</td>
						<td>2018-02-06 10:33:45</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>18</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206147</td>
						<td>2018-02-06 10:32:30</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206146</td>
						<td>2018-02-06 10:31:15</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206145</td>
						<td>2018-02-06 10:30:00</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>16</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206144</td>
						<td>2018-02-06 10:28:45</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206143</td>
						<td>2018-02-06 10:27:30</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206142</td>
						<td>2018-02-06 10:26:15</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>17</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206141</td>
						<td>2018-02-06 10:25:00</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206140</td>
						<td>2018-02-06 10:23:45</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>14</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206139</td>
						<td>2018-02-06 10:22:30</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>14</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206138</td>
						<td>2018-02-06 10:21:15</td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206137</td>
						<td>2018-02-06 10:20:00</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206136</td>
						<td>2018-02-06 10:18:45</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>15</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206135</td>
						<td>2018-02-06 10:17:30</td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>14</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206134</td>
						<td>2018-02-06 10:16:15</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>15</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206133</td>
						<td>2018-02-06 10:15:00</td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206132</td>
						<td>2018-02-06 10:13:45</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>8</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206131</td>
						<td>2018-02-06 10:12:30</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>17</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206130</td>
						<td>2018-02-06 10:11:15</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206129</td>
						<td>2018-02-06 10:10:00</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>6</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206128</td>
						<td>2018-02-06 10:08:45</td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>17</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206127</td>
						<td>2018-02-06 10:07:30</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>8</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206126</td>
						<td>2018-02-06 10:06:15</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206125</td>
						<td>2018-02-06 10:05:00</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>8</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206124</td>
						<td>2018-02-06 10:03:45</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206123</td>
						<td>2018-02-06 10:02:30</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>15</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206122</td>
						<td>2018-02-06 10:01:15</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206121</td>
						<td>2018-02-06 10:00:00</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>8</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206120</td>
						<td>2018-02-06 09:58:45</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>14</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206119</td>
						<td>2018-02-06 09:57:30</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206118</td>
						<td>2018-02-06 09:56:15</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>15</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206117</td>
						<td>2018-02-06 09:55:00</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206116</td>
						<td>2018-02-06 09:53:45</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206115</td>
						<td>2018-02-06 09:52:30</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206114</td>
						<td>2018-02-06 09:51:15</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>5</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206113</td>
						<td>2018-02-06 09:50:00</td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>16</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206112</td>
						<td>2018-02-06 09:48:45</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>3</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206111</td>
						<td>2018-02-06 09:47:30</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206110</td>
						<td>2018-02-06 09:46:15</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>5</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206109</td>
						<td>2018-02-06 09:45:00</td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>15</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206108</td>
						<td>2018-02-06 09:43:45</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>15</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206107</td>
						<td>2018-02-06 09:42:30</td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206106</td>
						<td>2018-02-06 09:41:15</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206105</td>
						<td>2018-02-06 09:40:00</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>6</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206104</td>
						<td>2018-02-06 09:38:45</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206103</td>
						<td>2018-02-06 09:37:30</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206102</td>
						<td>2018-02-06 09:36:15</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>14</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206101</td>
						<td>2018-02-06 09:35:00</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>17</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206100</td>
						<td>2018-02-06 09:33:45</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206099</td>
						<td>2018-02-06 09:32:30</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>17</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206098</td>
						<td>2018-02-06 09:31:15</td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>19</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206097</td>
						<td>2018-02-06 09:30:00</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>14</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206096</td>
						<td>2018-02-06 09:28:45</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206095</td>
						<td>2018-02-06 09:27:30</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206094</td>
						<td>2018-02-06 09:26:15</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>8</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206093</td>
						<td>2018-02-06 09:25:00</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>15</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206092</td>
						<td>2018-02-06 09:23:45</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206091</td>
						<td>2018-02-06 09:22:30</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206090</td>
						<td>2018-02-06 09:21:15</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206089</td>
						<td>2018-02-06 09:20:00</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206088</td>
						<td>2018-02-06 09:18:45</td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206087</td>
						<td>2018-02-06 09:17:30</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>6</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206086</td>
						<td>2018-02-06 09:16:15</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>15</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206085</td>
						<td>2018-02-06 09:15:00</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206084</td>
						<td>2018-02-06 09:13:45</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206083</td>
						<td>2018-02-06 09:12:30</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>14</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206082</td>
						<td>2018-02-06 09:11:15</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206081</td>
						<td>2018-02-06 09:10:00</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>14</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206080</td>
						<td>2018-02-06 09:08:45</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206079</td>
						<td>2018-02-06 09:07:30</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206078</td>
						<td>2018-02-06 09:06:15</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206077</td>
						<td>2018-02-06 09:05:00</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>16</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206076</td>
						<td>2018-02-06 09:03:45</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206075</td>
						<td>2018-02-06 09:02:30</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>14</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206074</td>
						<td>2018-02-06 09:01:15</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206073</td>
						<td>2018-02-06 09:00:00</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>14</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206072</td>
						<td>2018-02-06 08:58:45</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206071</td>
						<td>2018-02-06 08:57:30</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206070</td>
						<td>2018-02-06 08:56:15</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206069</td>
						<td>2018-02-06 08:55:00</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206068</td>
						<td>2018-02-06 08:53:45</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206067</td>
						<td>2018-02-06 08:52:30</td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206066</td>
						<td>2018-02-06 08:51:15</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206065</td>
						<td>2018-02-06 08:50:00</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206064</td>
						<td>2018-02-06 08:48:45</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>19</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206063</td>
						<td>2018-02-06 08:47:30</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>15</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206062</td>
						<td>2018-02-06 08:46:15</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>17</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206061</td>
						<td>2018-02-06 08:45:00</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>15</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206060</td>
						<td>2018-02-06 08:43:45</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206059</td>
						<td>2018-02-06 08:42:30</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>16</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206058</td>
						<td>2018-02-06 08:41:15</td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>15</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206057</td>
						<td>2018-02-06 08:40:00</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206056</td>
						<td>2018-02-06 08:38:45</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206055</td>
						<td>2018-02-06 08:37:30</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>5</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206054</td>
						<td>2018-02-06 08:36:15</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206053</td>
						<td>2018-02-06 08:35:00</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>15</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206052</td>
						<td>2018-02-06 08:33:45</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>6</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206051</td>
						<td>2018-02-06 08:32:30</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206050</td>
						<td>2018-02-06 08:31:15</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>8</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206049</td>
						<td>2018-02-06 08:30:00</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206048</td>
						<td>2018-02-06 08:28:45</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>8</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206047</td>
						<td>2018-02-06 08:27:30</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206046</td>
						<td>2018-02-06 08:26:15</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>18</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206045</td>
						<td>2018-02-06 08:25:00</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206044</td>
						<td>2018-02-06 08:23:45</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>14</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206043</td>
						<td>2018-02-06 08:22:30</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206042</td>
						<td>2018-02-06 08:21:15</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206041</td>
						<td>2018-02-06 08:20:00</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>14</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206040</td>
						<td>2018-02-06 08:18:45</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206039</td>
						<td>2018-02-06 08:17:30</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>16</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206038</td>
						<td>2018-02-06 08:16:15</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>6</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206037</td>
						<td>2018-02-06 08:15:00</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206036</td>
						<td>2018-02-06 08:13:45</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206035</td>
						<td>2018-02-06 08:12:30</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206034</td>
						<td>2018-02-06 08:11:15</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>14</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206033</td>
						<td>2018-02-06 08:10:00</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206032</td>
						<td>2018-02-06 08:08:45</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206031</td>
						<td>2018-02-06 08:07:30</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206030</td>
						<td>2018-02-06 08:06:15</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206029</td>
						<td>2018-02-06 08:05:00</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206028</td>
						<td>2018-02-06 08:03:45</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>5</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206027</td>
						<td>2018-02-06 08:02:30</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206026</td>
						<td>2018-02-06 08:01:15</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206025</td>
						<td>2018-02-06 08:00:00</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206024</td>
						<td>2018-02-06 07:58:45</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206023</td>
						<td>2018-02-06 07:57:30</td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>7</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206022</td>
						<td>2018-02-06 07:56:15</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206021</td>
						<td>2018-02-06 07:55:00</td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>6</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206020</td>
						<td>2018-02-06 07:53:45</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>8</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206019</td>
						<td>2018-02-06 07:52:30</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206018</td>
						<td>2018-02-06 07:51:15</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>15</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206017</td>
						<td>2018-02-06 07:50:00</td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td>14</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206016</td>
						<td>2018-02-06 07:48:45</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206015</td>
						<td>2018-02-06 07:47:30</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206014</td>
						<td>2018-02-06 07:46:15</td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td>4</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206013</td>
						<td>2018-02-06 07:45:00</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206012</td>
						<td>2018-02-06 07:43:45</td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td>18</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206011</td>
						<td>2018-02-06 07:42:30</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>9</td>
						<td>小</td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206010</td>
						<td>2018-02-06 07:41:15</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>11</td>
						<td>小</td>
						<td>单</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206009</td>
						<td>2018-02-06 07:40:00</td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206008</td>
						<td>2018-02-06 07:38:45</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>14</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206007</td>
						<td>2018-02-06 07:37:30</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>12</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206006</td>
						<td>2018-02-06 07:36:15</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td>8</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206005</td>
						<td>2018-02-06 07:35:00</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206004</td>
						<td>2018-02-06 07:33:45</td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td>16</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206003</td>
						<td>2018-02-06 07:32:30</td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td>13</td>
						<td><span class="font_red">大</span></td>
						<td>单</td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
					</tr>
					<tr>
						<td>180206002</td>
						<td>2018-02-06 07:31:15</td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td>10</td>
						<td>小</td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
					<tr>
						<td>180206001</td>
						<td>2018-02-06 07:30:00</td>
						<td><span class="ball c-n5"></span></td>
						<td><span class="ball c-n9"></span></td>
						<td><span class="ball c-n1"></span></td>
						<td><span class="ball c-n4"></span></td>
						<td><span class="ball c-n6"></span></td>
						<td><span class="ball c-n2"></span></td>
						<td><span class="ball c-n10"></span></td>
						<td><span class="ball c-n7"></span></td>
						<td><span class="ball c-n8"></span></td>
						<td><span class="ball c-n3"></span></td>
						<td>14</td>
						<td><span class="font_red">大</span></td>
						<td><span class="font_red">双</span></td>
						<td><span class="font_red">龙</span></td>
						<td><span class="font_red">龙</span></td>
						<td>虎</td>
						<td>虎</td>
						<td><span class="font_red">龙</span></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</template>

<script>
export default {
  //name: "header-top-frame-history"
  data() {
    return {
      value2: ""
    };
  }
};
</script>

<style scoped>
* {
  padding: 0;
  margin: 0;
}

table {
  border-collapse: collapse;
  border-spacing: 0;
}

body {
  font: 12px/1.5 "\5FAE\8F6F\96C5\9ED1", "\5b8b\4f53", Arial, Helvetica,
    sans-serif;
  overflow-y: hidden;
}

.u-table2 {
  width: 100%;
  text-align: center;
}

.cp-box2 {
  padding: 10px;
  width: 1030px;
}

.u-table2 th {
  font-size: 16px;
}

.u-table2 td {
  height: 28px;
  background: #fff;
  cursor: pointer;
}

.ball {
  display: inline-block;
  vertical-align: middle;
  background: url("/static/game/images/ball/ball-sprites.png") no-repeat 0 0;
}

#historyQueryParamGameId {
  border: 1px solid #dcdfe6;
  border-radius: 4px;
  height: 28px;
  box-sizing: border-box;
  vertical-align: bottom;
}

.c-b1,
.c-r1 {
  width: 24px;
  height: 25px;
  line-height: 26px;
  text-align: center;
  background-position: -117px -26px;
  font-size: 12px;
  color: #000;
}

.c-r1 {
  background-position: -117px 0;
}

.c-b2,
.c-r2,
.c-g2 {
  width: 27px;
  height: 27px;
  line-height: 27px;
  text-align: center;
  background-position: -187px 0;
  font-size: 12px;
  color: #000;
}

.c-b2 {
  background-position: -187px -54px;
}

.c-r2 {
  background-position: -187px -27px;
}

.c-n1,
.c-n2,
.c-n3,
.c-n4,
.c-n5,
.c-n6,
.c-n7,
.c-n8,
.c-n9,
.c-n10 {
  width: 23px;
  height: 23px;
}

.c-n1 {
  background-position: -142px -138px;
}

.c-n2 {
  background-position: -142px 0;
}

.c-n3 {
  background-position: -142px -115px;
}

.c-n4 {
  background-position: -142px -184px;
}

.c-n5 {
  background-position: -142px -92px;
}

.c-n6 {
  background-position: -142px -161px;
}

.c-n7 {
  background-position: -142px -207px;
}

.c-n8 {
  background-position: -142px -23px;
}

.c-n9 {
  background-position: -142px -69px;
}

.c-n10 {
  background-position: -142px -46px;
}
/*补发*/
</style>