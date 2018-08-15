<link rel="stylesheet" href="/vendor/zTree_v3/css/metroStyle/metroStyle.css">
<script type="text/javascript" src="/vendor/zTree_v3/js/jquery.ztree.core.min.js"></script>
<script type="text/javascript" src="/vendor/zTree_v3/js/jquery.ztree.excheck.js"></script>
<form id="editPermissionForm" class="ui form" action="{{ route('system.editPermission') }}">
    <div class="field">
        <label>权限名称</label>
        <div class="ui input icon">
            <input type="text" name="permission_name" id="permission_name" value="{{ $aPermissions->name }}"/>
        </div>
    </div>
    <div class="field">
        <label>权限分组</label>
        <div class="ui input icon">
            <input type="text" name="permission_group" id="permission_group" value="{{ $aPermissions->group_name }}"/>
        </div>
    </div>
    <div class="tree">
        <ul id="treeDemo" class="ztree"></ul>
    </div>
    <div class="field">
        <label>已选择权限 (<span id="checkCount">0</span>)</label>
        <div class="ui input icon">
            <input type="text" name="permission_selected" readonly id="permission_selected" value="{{ $aPermissions->auth }}"/>
        </div>
    </div>
    <input type="hidden" name="id" value="{{ $aPermissions->id }}">
</form>
<script>
    $(function () {
        var zTreeObj;
        var setting = {
            check: {
                enable: true,
                autoCheckTrigger: true,
                chkboxType: { "Y": "ps", "N": "ps" }
            },
            data:{
                simpleData: {
                    enable: true
                }
            },
            view: {
                expandSpeed: ""
            },
            callback: {
                onCheck: zTreeOnCheck//复选框选中
            }
        };
        var zNodes = [
            @foreach($aPermissionsAuths as $aPermissionsAuth)
                { id : '{{ $aPermissionsAuth->id }}',pId : '{{ $aPermissionsAuth->pid }}',name : '{{ $aPermissionsAuth->auth_name }}',value : '{{ $aPermissionsAuth->route_name }}'@if(in_array($aPermissionsAuth->route_name,$aPermissions->auth_array)) ,checked:true @endif},
                @if(!empty($aPermissionsAuth->child))
                    @foreach($aPermissionsAuth->child as $child)
                        { id : '{{ $child->id }}',pId : '{{ $child->pid }}',name : '{{ $child->auth_name }}',value : '{{ $child->route_name }}'@if(in_array($child->route_name,$aPermissions->auth_array)) ,checked:true @endif},
                        @if(!empty($child->child))
                            @foreach($child->child as $child2)
                                { id : '{{ $child2->id }}',pId : '{{ $child2->pid }}',name : '{{ $child2->auth_name }}',value : '{{ $child2->route_name }}'@if(in_array($child2->route_name,$aPermissions->auth_array)) ,checked:true @endif},
                            @endforeach
                        @endif
                    @endforeach
                @endif
            @endforeach
        ];
        zTreeObj = $.fn.zTree.init($("#treeDemo"), setting, zNodes);
        function zTreeOnCheck(){
            count();
            var nodes = zTreeObj.getCheckedNodes(true);
            var tempDepNames = new Array;
            $(nodes).each(function(index, obj) {
                tempDepNames.push(obj.value)
            });
            $('#permission_selected').val(tempDepNames);
        }
        
        function count() {
            var zTree = $.fn.zTree.getZTreeObj("treeDemo"),
            checkCount = zTree.getCheckedNodes(true).length;
            $("#checkCount").text(checkCount);
        }

        $('#editPermissionForm').formValidation({
            framework: 'semantic',
            icon: {
                valid: 'checkmark icon',
                invalid: 'remove icon',
                validating: 'refresh icon'
            },
            fields: {
                permission_name: {
                    validators: {
                        notEmpty: {
                            message: '请输入权限名称'
                        }
                    }
                },
                permission_selected:{
                    validators: {
                        notEmpty: {
                            message: '请至少选择一项权限'
                        }
                    }
                }
            }
        }).on('success.form.fv', function(e) {
            e.preventDefault();
            var $form = $(e.target),
                fv    = $form.data('formValidation');
            $.ajax({
                url: $form.attr('action'),
                type: 'POST',
                data: $form.serialize(),
                success: function(result) {
                    if(result.status == true){
                        jc1.close();
                        $('#example').DataTable().ajax.reload(null,false);
                    }else{
                        alert(result.msg);
                    }
                }
            });
        });
    })
</script>