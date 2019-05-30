<div class="sticky-header header-section ">
    <div class="header-left">
        <!--toggle button start-->
        <button id="showLeftPush"><i class="fa fa-bars"></i></button>
        <!--toggle button end-->
        <!--logo -->
        <div class="logo">
            <a href="/admins">
                <h1>NOVUS</h1>
                <span>AdminPanel</span>
            </a>
        </div>
        <!--//logo-->
        <!--search-box-->
        <!-- <div class="search-box">
            <form class="input">
                <input class="sb-search-input input__field--madoka" placeholder="Search..." type="search" id="input-31" />
                <label class="input__label" for="input-31">
                    <svg class="graphic" width="100%" height="100%" viewBox="0 0 404 77" preserveAspectRatio="none">
                        <path d="m0,0l404,0l0,77l-404,0l0,-77z"/>
                    </svg>
                </label>
            </form>
        </div> -->
        <!--//end-search-box-->
        <div class="clearfix"> </div>
    </div>
    <div class="header-right">
        <!--notification menu end -->
        <div class="profile_details">       
            <ul>
                <li class="dropdown profile_details_drop">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <div class="profile_img">   
                            <span class="prfil-img">
                                @if(!empty(session('userInfo')->uface))
                                <img src="/uploads/{{session('userInfo')->uface}}" class="img-circle" width="50px">
                                @endif
                            </span> 
                            <div class="user-name">
                                <p>{{session('userInfo')->uname}}</p>
                                <span>管理员</span>
                            </div>
                            <i class="fa fa-angle-down lnr"></i>
                            <i class="fa fa-angle-up lnr"></i>
                            <div class="clearfix"></div>    
                        </div>  
                    </a>
                    <ul class="dropdown-menu drp-mnu">
                        <li> <a href="/admin/index/edit/{{session('userInfo')->uid}}/{{session('userInfo')->token}}"><i class="fa fa-cog"></i> 修改密码</a> </li> 
                        <li> <a href="javascript:;" onclick="changeFace()"><i class="fa fa-user"></i> 头像</a> </li> 
                        <li> <a href="/admin/index/logout" class="logout"><i class="fa fa-sign-out"></i> 退出</a> </li>
                    </ul>
                </li>
            </ul>
            <script>
                // function logout() {
                //     if (!window.confirm('确定退出?')) {
                //         return false;
                //     }
                //     location.href = '/admin/index/logout';

                // }
                
                $.ajaxSetup({headers: {
                    'X-CSRF-TOKEN':
                        $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $(".logout").click(function(){
                    if (!window.confirm("确定退出?")) {
                        return false;
                    }
                });


                function changeFace(){
                    // uid = $(obj).attr('uid');
                    // alert($);
                    $('#myModal3').modal('show');
                }

            </script>
        </div>
        <div class="clearfix"> </div>
    </div>
    <div class="clearfix"> </div>   
</div>
<!-- Modal -->
<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">修改头像</h4>
            </div>
            <div class="modal-body">
                <form action="/admin/user/face" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="uface">选择新头像</label>
                        <!-- <br> -->
                        <input type="file" style="width: 80%;" class="form-control" name="uface" id="uface">
                        <input type="hidden" name="uid" value="{{session('userInfo')->uid}}">
                        <input type="hidden" name="uface_path" value="{{session('userInfo')->uface}}">
                    </div>
                    <!-- <br> -->
                    <button type="submit" class="btn btn-info">提交</button>
                </form>
            </div>
        </div>
    </div>
</div>
