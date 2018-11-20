/*--------------------------------------------------|
| dTree 2.05 | www.destroydrop.com/javascript/tree/ |
|---------------------------------------------------|
| Copyright (c) 2009-2010 Geir Landr?              |
|                                                   |
| This script can be used freely as long as all     |
| copyright messages are intact.                    |
|                                                   |
| Updated: 20.07.2009                               |
|--------------------------------------------------*/


//=
// john 2017-06-30
//=
//�޸���ʷ��
//1  ��dtree�޸ĳɿ���ѡ���Ȩ������
//   ��nameת���<input type='checkbox'>
//
//=
//�ڵ����  -- Node object
function Node(id, pid, cname, cvalue, cshow, cchecked, cdisabled, url, title, target, icon, iconOpen, open) {
    this.id = id;                        // int ÿ���ڵ㶼��ΨһID�����ӽڵ�ʱ��Ҫ�ֹ�����һ��ID�� 
    this.pid = pid;                      // int ���ڵ�ID�����ڵ�ĸ��ڵ���-1�� 
    this.cname = cname;                  // chechbox������    
    this.cvalue = cvalue;                // chechbox��ֵ    
    this.cshow = cshow;                  // chechbox����ʾ    
    this.cchecked = cchecked || false;   // chechbox�Ƿ�ѡ�У�Ĭ���ǲ�ѡ   
    this.cdisabled = cdisabled || false; // chechbox�Ƿ���ã�Ĭ���ǿ���    
    this.url = url || '#';               // �ڵ����ӣ�Ĭ����������  String �ڵ�URL���������ת��ַ�� 
    this.title = title;                  // ����ƶ����ڵ�����ʾ������ 
    this.target = target;                // String ҳ����ת���ڵ�frame 
    this.icon = icon;                    // String �ڵ�ر�ʱ��ʾ��ͼ���ַ 
    this.iconOpen = iconOpen;            // String �ڵ��ʱ��ʾ��ͼ���ַ 
    this._io = open || false;            // boolean �ڵ��Ƿ��Ѵ򿪣�Ĭ��ֵfalse�� 
    this._is = false;                    // boolean �ڵ��Ƿ��Ѵ򿪣�Ĭ��ֵfalse�� 
    this._ls = false;                    // boolean �Ƿ������һ���ڵ㣬Ĭ��ֵfalse��  
    this._hc = false;                    // boolean �Ƿ����ӽڵ㣬Ĭ��ֵfalse�� 
    this._ai = 0;                        // int �����Ľڵ������е��±�(λ��)��Ĭ��ֵ0�� 
    this._p;                             // Node ���ڵ����Ĭ��ֵnull�� 
};

//������ Tree object
function dTree(objName, objbool) {        // void ���췽��������������objName: �����ơ�objbool����ѡ��ѡ true��ѡ  false��ѡ  Ĭ�ϵ�ѡ         
    this.config = {
        target: null,            // �������нڵ��target��Ĭ��null 
        folderLinks: false,      // Ŀ¼�ڵ��Ƿ����������,Ĭ��true 
        useSelection: false,     // �ڵ��Ƿ���Ա�ѡ��(����),Ĭ��true
        useCookies: false,       // ����ʹ��cookies��������״̬,Ĭ��true 
        useLines: true,          // �Ƿ���ʾ·������,Ĭ��true 
        useIcons: false,         // �Ƿ���ʾͼ��,Ĭ��true 
        useStatusText: true,     // �Ƿ���״̬������ڵ����֣��滻ԭ����url��ʾ��,Ĭ��false
        closeSameLevel: false,   // �Ƿ��Զ��ر��ֵܽڵ㣨���򿪱��ڵ�ʱ��,ע������trueʱ��openAll()��closeAll()���ܹ�����Ĭ��false 
        inOrder: false           // ������ڵ��������ӽڵ�֮ǰ������������true�и��õ�Ч�ʣ�Ĭ��false 
    }
    this.icon = {
        root:        '/back/img/base.gif',         // Node ���ڵ㡣
        folder:      '/back/img/folder.gif',       // Node ���ڵ㡣
        folderOpen:  '/back/img/folderopen.gif',   // �򿪵��ļ���,Ĭ��'img/folderOpen.gif'
        node:        '/back/img/page.gif',         // �򿪵��ļ���,Ĭ��'img/folderOpen.gif'
        empty:       '/back/img/empty.gif',        // �򿪵��ļ���,Ĭ��'img/folderOpen.gif'
        line:        '/back/img/line.gif',         // ����,Ĭ��'img/line.gif'
        join:        '/back/img/join.gif',         // ����,Ĭ��'img/join.gif'
        joinBottom:  '/back/img/joinbottom.gif',   // ֱ����,Ĭ��'img/joinbottom.gif'
        plus:        '/back/img/plus.gif',         // �ӺŶ���,Ĭ��'img/plus.gif'
        plusBottom:  '/back/img/plusbottom.gif',   // �Ӻ�ֱ����,Ĭ��'img/plusbottom.gif'
        minus:       '/back/img/minus.gif',        // ���Ŷ���,Ĭ��'img/minus.gif'
        minusBottom: '/back/img/minusbottom.gif',  // ����ֱ����,Ĭ��'img/minusbottom.gif'
        nlPlus:      '/back/img/nolines_plus.gif', // ����ֱ����,Ĭ��'img/minusbottom.gif'
        nlMinus:     '/back/img/nolines_minus.gif' //���߼���,Ĭ��'img/nolines_minus.gif'
    };
    this.obj = objName;          // String �������ƣ��ڴ�����ʱ���塣 
    this.aNodes = [];            // Node[] ���еĽڵ����顣 
    this.aIndent = [];           // [] ���顣
    this.root = new Node(-1);    // ���ڵ㡣 
    this.selectedNode = null;    // ��ǰѡ��Ľڵ㡣
    this.selectedFound = false;  // �Ƿ���ѡ�нڵ㣬Ĭ��false�� 
    this.completed = false;      // ������html�Ƿ��������ɣ�Ĭ��false��
    this.RadioRocheckbox = objbool |false ;//��ѡ��ѡ
};

//���һ���½ڵ㵽�ڵ�������   --Adds a new node to the node array
dTree.prototype.add = function (id, pid, cname, cvalue, cshow, cchecked, cdisabled, url, title, target, icon, iconOpen, open) {
    this.aNodes[this.aNodes.length] = new Node(id, pid, cname, cvalue, cshow, cchecked, cdisabled, url, title, target, icon, iconOpen, open);
};

//��/�ر����нڵ�   Open/close all nodes
dTree.prototype.openAll = function () {
    this.oAll(false);
};
dTree.prototype.closeAll = function () {
    this.oAll(true);
};

//�������ҳ����  -- Outputs the tree to the page
dTree.prototype.toString = function () {
    var str = '<div class="dtree_Tree">\n';
    if (document.getElementById) {
        if (this.config.useCookies) this.selectedNode = this.getSelected();
        str += this.addNode(this.root);
    } else str += 'Browser not supported.';
    str += '</div>';
    if (!this.selectedFound) this.selectedNode = null;
    this.completed = true;
    return str;
};

//�������νṹ  -- Creates the tree structure
dTree.prototype.addNode = function (pNode) {
    var str = '';
    var n = 0;
    if (this.config.inOrder) n = pNode._ai;
    for (n; n < this.aNodes.length; n++) {
        if (this.aNodes[n].pid == pNode.id) {
            var cn = this.aNodes[n];
            cn._p = pNode;
            cn._ai = n;
            this.setCS(cn);
            if (!cn.target && this.config.target) cn.target = this.config.target;
            if (cn._hc && !cn._io && this.config.useCookies) cn._io = this.isOpen(cn.id);
            if (!this.config.folderLinks && cn._hc) cn.url = null;
            if (this.config.useSelection && cn.id == this.selectedNode && !this.selectedFound) {
                cn._is = true;
                this.selectedNode = n;
                this.selectedFound = true;
            }
            str += this.node(cn, n);
            if (cn._ls) break;
        }
    }
    return str;
};



//�����ڵ�ͼ��,url���ı�  --Creates the node icon, url and text
dTree.prototype.node = function (node, nodeId) {
    var str = "";
    if (node.pid == -1) {
        str += '<div class="dTreeNode rootNode">' + this.indent(node, nodeId);
    }
    else {
        str += '<div class="dTreeNode">' + this.indent(node, nodeId);
    }
    if (this.config.useIcons) {
        if (!node.icon) node.icon = (this.root.id == node.pid) ? this.icon.root : ((node._hc) ? this.icon.folder : this.icon.node);
        if (!node.iconOpen) node.iconOpen = (node._hc) ? this.icon.folderOpen : this.icon.node;
        if (this.root.id == node.pid) {
            node.icon = this.icon.root;
            node.iconOpen = this.icon.root;
        }
        str += '<img id="i' + this.obj + nodeId + '" src="' + ((node._io) ? node.iconOpen : node.icon) + '" alt="" />';
    }
    if (node.url) {
        str += '<a id="s' + this.obj + nodeId + '" class="' + ((this.config.useSelection) ? ((node._is ? 'nodeSel' : 'node')) : 'node') + '" href="' + node.url + '"';
        if (node.title) str += ' title="' + node.title + '"';
        if (node.target) str += ' target="' + node.target + '"';
        if (this.config.useStatusText) str += ' onmouseover="window.status=\'' + node.cname + '\';return true;" onmouseout="window.status=\'\';return true;" ';
        if (this.config.useSelection && ((node._hc && this.config.folderLinks) || !node._hc))
            str += ' onclick="javascript: ' + this.obj + '.s(' + nodeId + ');"';
        str += '>';
    }
    else if ((!this.config.folderLinks || !node.url) && node._hc && node.pid != this.root.id)
        str += '<a href="javascript: ' + this.obj + '.o(' + nodeId + ');" class="node">';

    //=====
    //2009-07-11 ��ԭ���ӵĽڵ��޸�Ϊ checkbox
    //=====
    //str += node.name;

    if (node.pid == this.root.id) {
        if (node.pid == -1) {
            str += "<a>";
        }
        str += node.cname;
    } else {
        var checkboxSyntax = "";
        //�Ƿ����
        if (node.cchecked) {
            checkboxSyntax = "<span class='dtree_node' node_id='" + node.id + "'>" + node.cshow + "</span>";
        }
        else {            
            /**��װcheckbox��ʼ*/            
            if (this.RadioRocheckbox) {
                checkboxSyntax = "<input type='checkbox' desc='" + node.cshow + "' name='" + node.cname + "' id='" + node.cname + "_" + node.id + "' cshow='" + node.cshow + "'  value='" + node.cvalue + "' onClick='javascript: " + this.obj + ".checkNode(" + node.id + "," + node.pid + "," + node._hc + ",this.checked);' ";
            }
            else {
                checkboxSyntax = "<input type='radio' desc='" + node.cshow + "' name='" + node.cname + "' id='" + node.cname + "_" + node.id + "' cshow='" + node.cshow + "' value='" + node.cvalue + "' onClick='javascript: " + this.obj + ".checkNode(" + node.id + "," + node.pid + "," + node._hc + ",this.checked);' ";
            }
            if (node.cchecked)
                checkboxSyntax += " checked ";

            if (node.cdisabled)
                checkboxSyntax += " disabled ";

            checkboxSyntax += ">" + "<span class='dtree_node' node_id='" + node.id + "'>" + node.cshow + "</span>";
            /**��װcheckbox����*/
        }
        str += checkboxSyntax;
    }

    if (node.url || ((!this.config.folderLinks || !node.url) && node._hc)) str += '</a>';
    str += '</div>';
    if (node._hc) {
        str += '<div id="d' + this.obj + nodeId + '" class="clip" style="display:' + ((this.root.id == node.pid || node._io) ? 'block' : 'none') + ';">';
        str += this.addNode(node);
        str += '</div>';
    }
    this.aIndent.pop();
    return str;
};

//��ӿպ���ͼ��  -- Adds the empty and line icons
dTree.prototype.indent = function (node, nodeId) {
    var str = '';
    if (this.root.id != node.pid) {
        for (var n = 0; n < this.aIndent.length; n++)
            str += '<img src="' + ((this.aIndent[n] == 1 && this.config.useLines) ? this.icon.line : this.icon.empty) + '" alt="" />';
        (node._ls) ? this.aIndent.push(0) : this.aIndent.push(1);
        if (node._hc) {
            str += '<a href="javascript: ' + this.obj + '.o(' + nodeId + ');"><img id="j' + this.obj + nodeId + '" src="';
            if (!this.config.useLines) str += (node._io) ? this.icon.nlMinus : this.icon.nlPlus;
            else str += ((node._io) ? ((node._ls && this.config.useLines) ? this.icon.minusBottom : this.icon.minus) : ((node._ls && this.config.useLines) ? this.icon.plusBottom : this.icon.plus));
            str += '" alt="" /></a>';
        } else str += '<img src="' + ((this.config.useLines) ? ((node._ls) ? this.icon.joinBottom : this.icon.join) : this.icon.empty) + '" alt="" />';
    }
    return str;
};

//����Ƿ����κ�һ���ڵ�ĺ�����������һ���ֵܽ���  -- Checks if a node has any children and if it is the last sibling
dTree.prototype.setCS = function (node) {
    var lastId;
    for (var n = 0; n < this.aNodes.length; n++) {
        if (this.aNodes[n].pid == node.id) node._hc = true;
        if (this.aNodes[n].pid == node.pid) lastId = this.aNodes[n].id;
    }
    if (lastId == node.id) node._ls = true;
};

//����ѡ�еĽڵ�  -- Returns the selected node
dTree.prototype.getSelected = function () {
    var sn = this.getCookie('cs' + this.obj);
    return (sn) ? sn : null;
};

//===
// john 2017-06-30
//
//���ã��Ƴ������ѡ���ֵ�������Ƴ�������ѡ�е�ֵ
//������obj obj����
//      event event����
//===
dTree.prototype.doRemove = function (obj, event) {    
    var width = $(obj).width();
    var left = $(obj).position().left;
    var e = event || window.event;
    var x = IsIE(GetVersion()) ? e.x : e.pageX;
    if (x > left + width - 9) {
        $(obj).parent().remove();
        var userid = $(obj).parent().attr("uid");
        var type = $(obj).parent().attr("mytype");
        if (this.RadioRocheckbox) {
            var $chk = $('.dtree_Tree a input[type="checkbox"][value="' + userid + '"]');
            if ($chk.length > 0) {
                $chk.attr('checked', false);
            }
        }
        else {
            var $chk = $('.dtree_Tree a input[type="radio"][value="' + userid + '"]');
            if ($chk.length > 0) {
                $chk.attr('checked', false);
            }
        }
    }
}


//===
// john 2017-06-30
//
//���ã�ѡ�нڵ����
//������nobj node����
//      cobj checkbox����
//===
dTree.prototype.checkNode = function (id, pid, _hc, checked) {
    ////1���ݹ�ѡ���ڵ����������Ҷ�ڵ㻹���м�ڵ㣩
    ////�ж�ͬ�������ޱ�ѡ�еģ������ѡ�еľͲ����Է�ѡ
    //if (!this.isHaveBNode(id, pid)) {
    //    if (checked) {
    //        //ѡ�о�һֱѡ�����ڵ�
    //        this.checkPNodeRecursion(pid, checked);
    //    } else {
    //        //ȥ��ѡ�н����丸�ڵ�ȥ��ѡ��
    //        this.checkPNode(pid, checked);
    //    }
    //}

    ////2��������м��㣬���ж��ӣ��ݹ�ѡ�ӽڵ����		
    //if (_hc)
    //    this.checkSNodeRecursion(id, checked);
    var count = 0;
    var obj = document.all.authority;

    for (i = 0; i < obj.length; i++) {        
        if (obj[i].checked) {            
            if (!this.RadioRocheckbox) {
                $("#ulSelected").empty();
            }            
            if ($("#ulSelected #user_" + obj[i].value + "").length>0) {               
            }
            else {
                var strU = '<li id="user_' + obj[i].value + '"  uid="' + obj[i].value + '" name="' + obj[i].getAttribute("cshow") + '" mytype="2"> <div class="selectedUser" onmouseover="showRemove(this)" onmouseout="hideRemove(this)" onmousemove="setRemove(this,event)" onclick="javascript: ' + this.obj + '.doRemove(this,event);" style="cursor: pointer;">' + obj[i].getAttribute("cshow") + ' </div></li>';
                $("#ulSelected").append(strU);
                count++;
            }
        }
        else {
            $("#ulSelected #user_" + obj[i].value + "").remove();
        }
    }
}

//===
// john 2017-06-30
//
//���ã��ж�ͬ�������ޱ�ѡ�е�
//������id �ڵ�id
//      pid �ڵ�ĸ��ڵ�id
//===
dTree.prototype.isHaveBNode = function (id, pid) {
    var isChecked = false
    for (var n = 0; n < this.aNodes.length; n++) {
        // ���ǽڵ���������ͬ���ڵ��ֵܽڵ�
        if (this.aNodes[n].pid != -1 && this.aNodes[n].id != id && this.aNodes[n].pid == pid) {
            if (eval("document.all." + this.aNodes[n].cname + "_" + this.aNodes[n].id + ".checked"))
                isChecked = true;
        }
    }
    return isChecked;
};

//===
// john 2017-06-30
//
//���ã��ݹ�ѡ�и��ڵ����
//������pid �ڵ�ĸ��ڵ�id
//      ischecked �Ƿ�ѡ��
//===
dTree.prototype.checkPNodeRecursion = function (pid, ischecked) {
    for (var n = 0; n < this.aNodes.length; n++) {
        if (this.aNodes[n].pid != -1 && this.aNodes[n].id == pid) {
            eval("document.all." + this.aNodes[n].cname + "_" + this.aNodes[n].id + ".checked = " + ischecked);
            this.checkPNodeRecursion(this.aNodes[n].pid, ischecked);
            break;
        }
    }
};

//===
// john 2017-06-30
//
//���ã��ݹ�ѡ���ӽڵ����
//������id �ڵ�id
//      ischecked �Ƿ�ѡ��
//===
dTree.prototype.checkSNodeRecursion = function (id, ischecked) {
    for (var n = 0; n < this.aNodes.length; n++) {
        if (this.aNodes[n].pid != -1 && this.aNodes[n].pid == id) {
            eval("document.all." + this.aNodes[n].cname + "_" + this.aNodes[n].id + ".checked = " + ischecked);
            this.checkSNodeRecursion(this.aNodes[n].id, ischecked);
        }
    }
};

//===
// john 2017-06-30
//
//���ã���ѡ�и��ڵ����
//������pid �ڵ�ĸ��ڵ�id
//      ischecked �Ƿ�ѡ��
//===
dTree.prototype.checkPNode = function (pid, ischecked) {
    for (var n = 0; n < this.aNodes.length; n++) {
        if (this.aNodes[n].pid != -1 && this.aNodes[n].id == pid) {
            eval("document.all." + this.aNodes[n].cname + "_" + this.aNodes[n].id + ".checked = " + ischecked);
            break;
        }
    }
};

//ͻ����ѡ�еĽڵ�  -- Highlights the selected node
dTree.prototype.s = function (id) {
    if (!this.config.useSelection) return;
    var cn = this.aNodes[id];
    if (cn._hc && !this.config.folderLinks) return;
    if (this.selectedNode != id) {
        if (this.selectedNode || this.selectedNode == 0) {
            eOld = document.getElementById("s" + this.obj + this.selectedNode);
            eOld.className = "node";
        }
        eNew = document.getElementById("s" + this.obj + id);
        eNew.className = "nodeSel";
        this.selectedNode = id;
        if (this.config.useCookies) this.setCookie('cs' + this.obj, cn.id);
    }
};

//���ش򿪻�ر�   Toggle Open or close
dTree.prototype.o = function (id) {
    var cn = this.aNodes[id];
    this.nodeStatus(!cn._io, id, cn._ls);
    cn._io = !cn._io;
    if (this.config.closeSameLevel) this.closeLevel(cn);
    if (this.config.useCookies) this.updateCookie();
};

//�򿪻�ر����нڵ�  -- Open or close all nodes
dTree.prototype.oAll = function (status) {
    for (var n = 0; n < this.aNodes.length; n++) {
        if (this.aNodes[n]._hc && this.aNodes[n].pid != this.root.id) {
            this.nodeStatus(status, n, this.aNodes[n]._ls)
            this.aNodes[n]._io = status;
        }
    }
    if (this.config.useCookies) this.updateCookie();
};

//������һ���ض��Ľڵ�  -- Opens the tree to a specific node
dTree.prototype.openTo = function (nId, bSelect, bFirst) {
    if (!bFirst) {
        for (var n = 0; n < this.aNodes.length; n++) {
            if (this.aNodes[n].id == nId) {
                nId = n;
                break;
            }
        }
    }
    var cn = this.aNodes[nId];
    if (cn.pid == this.root.id || !cn._p) return;
    cn._io = true;
    cn._is = bSelect;
    if (this.completed && cn._hc) this.nodeStatus(true, cn._ai, cn._ls);
    if (this.completed && bSelect) this.s(cn._ai);
    else if (bSelect) this._sn = cn._ai;
    this.openTo(cn._p._ai, false, true);
};

//�ر����нڵ���ͬ�Ĳ����,ĳЩ�ڵ�   --Closes all nodes on the same level as certain node
dTree.prototype.closeLevel = function (node) {
    for (var n = 0; n < this.aNodes.length; n++) {
        if (this.aNodes[n].pid == node.pid && this.aNodes[n].id != node.id && this.aNodes[n]._hc) {
            this.nodeStatus(false, n, this.aNodes[n]._ls);
            this.aNodes[n]._io = false;
            this.closeAllChildren(this.aNodes[n]);
        }
    }
}

//�ر�����һ���ڵ�ͽڵ�������ӽڵ� -- Closes all children of a node
dTree.prototype.closeAllChildren = function (node) {
    for (var n = 0; n < this.aNodes.length; n++) {
        if (this.aNodes[n].pid == node.id && this.aNodes[n]._hc) {
            if (this.aNodes[n]._io) this.nodeStatus(false, n, this.aNodes[n]._ls);
            this.aNodes[n]._io = false;
            this.closeAllChildren(this.aNodes[n]);
        }
    }
}

// ���Ľڵ��״̬(�򿪻�ر�) Change the status of a node(open or closed)
dTree.prototype.nodeStatus = function (status, id, bottom) {
    eDiv = document.getElementById('d' + this.obj + id);
    eJoin = document.getElementById('j' + this.obj + id);
    if (this.config.useIcons) {
        eIcon = document.getElementById('i' + this.obj + id);
        eIcon.src = (status) ? this.aNodes[id].iconOpen : this.aNodes[id].icon;
    }
    eJoin.src = (this.config.useLines) ?
	((status) ? ((bottom) ? this.icon.minusBottom : this.icon.minus) : ((bottom) ? this.icon.plusBottom : this.icon.plus)) :
	((status) ? this.icon.nlMinus : this.icon.nlPlus);
    eDiv.style.display = (status) ? 'block' : 'none';
};


//[Cookie]���Cookie -- [Cookie] Clears a cookie
dTree.prototype.clearCookie = function () {
    var now = new Date();
    var yesterday = new Date(now.getTime() - 1000 * 60 * 60 * 24);
    this.setCookie('co' + this.obj, 'cookieValue', yesterday);
    this.setCookie('cs' + this.obj, 'cookieValue', yesterday);
};

// [Cookie] ��Cookie������ֵ --[Cookie] Sets value in a cookie
dTree.prototype.setCookie = function (cookieName, cookieValue, expires, path, domain, secure) {
    document.cookie =
		escape(cookieName) + '=' + escape(cookieValue)
		+ (expires ? '; expires=' + expires.toGMTString() : '')
		+ (path ? '; path=' + path : '')
		+ (domain ? '; domain=' + domain : '')
		+ (secure ? '; secure' : '');
};

//[Cookie]��Cookie�еõ���һ��ֵ -- [Cookie] Gets a value from a cookie
dTree.prototype.getCookie = function (cookieName) {
    var cookieValue = '';
    var posName = document.cookie.indexOf(escape(cookieName) + '=');
    if (posName != -1) {
        var posValue = posName + (escape(cookieName) + '=').length;
        var endPos = document.cookie.indexOf(';', posValue);
        if (endPos != -1) cookieValue = unescape(document.cookie.substring(posValue, endPos));
        else cookieValue = unescape(document.cookie.substring(posValue));
    }
    return (cookieValue);
};

//[Cookie]���򿪽ڵ��id��Ϊ�ַ�������  -- [Cookie] Returns ids of open nodes as a string
dTree.prototype.updateCookie = function () {
    var str = '';
    for (var n = 0; n < this.aNodes.length; n++) {
        if (this.aNodes[n]._io && this.aNodes[n].pid != this.root.id) {
            if (str) str += '.';
            str += this.aNodes[n].id;
        }
    }
    this.setCookie('co' + this.obj, str);
};

// [Cookie]���һ���ڵ�id�Ƿ���Cookie��-- [Cookie] Checks if a node id is in a cookie
dTree.prototype.isOpen = function (id) {
    var aOpen = this.getCookie('co' + this.obj).split('.');
    for (var n = 0; n < aOpen.length; n++)
        if (aOpen[n] == id) return true;
    return false;
};

// ���Push��pop�����������ʵ�ֵ�-- If Push and pop is not implemented by the browser
if (!Array.prototype.push) {
    Array.prototype.push = function array_push() {
        for (var i = 0; i < arguments.length; i++)
            this[this.length] = arguments[i];
        return this.length;
    }
};
if (!Array.prototype.pop) {
    Array.prototype.pop = function array_pop() {
        lastElement = this[this.length - 1];
        this.length = Math.max(this.length - 1, 0);
        return lastElement;
    }
};