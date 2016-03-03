<style type="text/css">
    dl{
        margin-top: 0px;
        margin-bottom: 0px;
    }
    dl dt{
        color: #000;
    }
    dl dd{
        font-size: 9pt;
        color: #aaa;
    }
    .list-group-item{
        padding-top: 0px;
        padding-bottom: 0px;
    }
</style>
<ul class="list-group">
    <?php for($i = 1; $i < 10; $i ++) { ?>
        <li class="list-group-item">
            <a href="/room/view/<?php echo $i;?>">
                <div class="row">
                    <div class="col-xs-5" style="padding-right: 0px;">
                        <img src="http://bpic.pic138.com/12/16/91/22bOOOPIC57_1024.jpg" alt="" style="width: 100%;"/>
                    </div>
                    <div class="col-xs-7">
                        <dl>
                            <dt>国会量贩</dt>
                            <dd>地址: 汉台区学院路29号天河商业广场5楼</dd>
                            <dd class="clearfix"><span class="pull-left">会员价折</span> <span class="pull-right">人均消费</span></dd>
                            <dd>免费WIFI/免费停车</dd>
                        </dl>
                    </div>
                </div>
            </a>
        </li>
    <?php } ?>
</ul>