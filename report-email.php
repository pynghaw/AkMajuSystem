<?php 
  include('dbconnect.php');
  include 'headermain.php';

?>
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Home</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="email-left-box"><a href="email-compose.html" class="btn btn-primary btn-block">Compose</a>
                            <div class="mail-list mt-4"><a href="email-inbox.html" class="list-group-item border-0 text-primary p-r-0"><i class="fa fa-inbox font-18 align-middle mr-2"></i> <b>Inbox</b> <span class="badge badge-primary badge-sm float-right m-t-5">198</span> </a>
                                <a href="#" class="list-group-item border-0 p-r-0"><i class="fa fa-paper-plane font-18 align-middle mr-2"></i>Sent</a>  <a href="#" class="list-group-item border-0 p-r-0"><i class="fa fa-star-o font-18 align-middle mr-2"></i>Important <span class="badge badge-danger badge-sm float-right m-t-5">47</span> </a>
                                <a href="#" class="list-group-item border-0 p-r-0"><i class="mdi mdi-file-document-box font-18 align-middle mr-2"></i>Draft</a><a href="#" class="list-group-item border-0 p-r-0"><i class="fa fa-trash font-18 align-middle mr-2"></i>Trash</a>
                            </div>
                            <h5 class="mt-5 m-b-10">Categories</h5>
                            <div class="list-group mail-list"><a href="#" class="list-group-item border-0"><span class="fa fa-briefcase f-s-14 mr-2"></span>Work</a>  <a href="#" class="list-group-item border-0"><span class="fa fa-sellsy f-s-14 mr-2"></span>Private</a>  <a href="#"
                                class="list-group-item border-0"><span class="fa fa-ticket f-s-14 mr-2"></span>Support</a>  <a href="#" class="list-group-item border-0"><span class="fa fa-tags f-s-14 mr-2"></span>Social</a>
                            </div>
                        </div>
                        <div class="email-right-box">
                            <div class="toolbar" role="toolbar">
                                <div class="btn-group m-b-20">
                                    <button type="button" class="btn btn-light"><i class="fa fa-archive"></i>
                                    </button>
                                    <button type="button" class="btn btn-light"><i class="fa fa-exclamation-circle"></i>
                                    </button>
                                    <button type="button" class="btn btn-light"><i class="fa fa-trash"></i>
                                    </button>
                                </div>
                                <div class="btn-group m-b-20">
                                    <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown"><i class="fa fa-folder"></i>  <b class="caret m-l-5"></b>
                                    </button>
                                    <div class="dropdown-menu"><span class="dropdown-header">Move to</span>  <a class="dropdown-item" href="javascript: void(0);">Social</a>  <a class="dropdown-item" href="javascript: void(0);">Promotions</a>  <a class="dropdown-item" href="javascript: void(0);">Updates</a> 
                                        <a class="dropdown-item" href="javascript: void(0);">Forums</a>
                                    </div>
                                </div>
                                <div class="btn-group m-b-20">
                                    <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown"><i class="fa fa-tag"></i>  <b class="caret m-l-5"></b>
                                    </button>
                                    <div class="dropdown-menu"><span class="dropdown-header">Label as:</span>  <a class="dropdown-item" href="javascript: void(0);">Updates</a>  <a class="dropdown-item" href="javascript: void(0);">Social</a>  <a class="dropdown-item" href="javascript: void(0);">Promotions</a> 
                                        <a class="dropdown-item" href="javascript: void(0);">Forums</a>
                                    </div>
                                </div>
                                <div class="btn-group m-b-20">
                                    <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">More <span class="caret m-l-5"></span>
                                    </button>
                                    <div class="dropdown-menu"><span class="dropdown-header">More Option :</span>  <a class="dropdown-item" href="javascript: void(0);">Mark as Unread</a>  <a class="dropdown-item" href="javascript: void(0);">Add to Tasks</a>  <a class="dropdown-item"
                                        href="javascript: void(0);">Add Star</a>  <a class="dropdown-item" href="javascript: void(0);">Mute</a>
                                    </div>
                                </div>
                            </div>
                            <div class="compose-content mt-5">
                                <form action="#">
                                    <div class="form-group">
                                        <input type="text" class="form-control bg-transparent" placeholder=" To">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control bg-transparent" placeholder=" Subject">
                                    </div>
                                    <div class="form-group">
                                        <textarea class="textarea_editor form-control bg-light" rows="15" placeholder="Enter text ..."></textarea>
                                    </div>
                                </form>
                                <h5 class="m-b-20"><i class="fa fa-paperclip m-r-5 f-s-18"></i> Attatchment</h5>
                                <form action="#" class="dropzone">
                                    <div class="form-group">
                                        <div class="fallback">
                                            <input class="l-border-1" name="file" type="file" multiple="multiple">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="text-left m-t-15">
                                <button class="btn btn-primary m-b-30 m-t-15 f-s-14 p-l-20 p-r-20 m-r-10" type="button"><i class="fa fa-paper-plane m-r-5"></i> Send</button>
                                <button class="btn btn-dark m-b-30 m-t-15 f-s-14 p-l-20 p-r-20" type="button"><i class="ti-close m-r-5 f-s-12"></i> Discard</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- #/ container -->
</div>

<?php include 'footer.php'; ?>

