
<?php
$v1 = $_GET['url'];
$v2 = $_GET['rotacion'];
?>
<!doctype html>
<head>
    <title>Visor</title>
    <link href="f5.css" media="all" rel="stylesheet" type="text/css" >
    <script type="text/javascript" src="protoculous.js"></script>
    <script type="text/javascript" src="image-zoom.js"></script>
    <style>
        .img-container img { 
            cursor: pointer; 
        } 
        .rot0 { 
            -webkit-transform: rotate(0deg); 
            -moz-transform: rotate(0deg); 
            rotation: 0deg; 
            filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=0); 
        } 
        .rot90 { 
            -webkit-transform: rotate(90deg); 
            -moz-transform: rotate(90deg); 
            rotation: 90deg; 
            filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=1); 
        } 
        .rot180 { 
            -webkit-transform: rotate(180deg); 
            -moz-transform: rotate(180deg); 
            rotation: 180deg; 
            filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=2); 
        } 
        .rot270 { 
            -webkit-transform: rotate(270deg); 
            -moz-transform: rotate(270deg); 
            filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3); 
        } 
    </style>
</head>


<body>

    <div id="file-preview">
        <input id="ZoomFileID" type="hidden" value="1" />
        <input id="ZoomFactor" type="hidden" value="1" />
        <input id="ZoomMaxSize" type="hidden" value="10000" />
        <input id="ViewPortSize" type="hidden" value="" />
        <input id="PanoramicPercent" type="hidden" value="" />
        <input id="nameImagen" type="hidden" value="../<?php echo $v1; ?>" />
        <input id="class" type="hidden" value="<?php echo $v2; ?>" />
        <div disabled="true"id="Divrotacion" style="width:150px;height:100%;border:1px solid;float:left;" >
            <p>Rotacion: 
                <select onchange="document.location.href = this.options[this.selectedIndex].value;">
                    <?php echo '<option value="visor.php?url=' . $v1 . '&rotacion=rot0">rot0</option>'; ?>
                    <?php echo '<option value="visor.php?url=' . $v1 . '&rotacion=rot90">rot90</option>'; ?>
                    <?php echo '<option value="visor.php?url=' . $v1 . '&rotacion=rot180">rot180</option>'; ?>
                    <?php echo '<option value="visor.php?url=' . $v1 . '&rotacion=rot270">rot270</option>'; ?>
                </select>
        </div>
        <div id="ZoomImageDiv" >
            <div id="ActualImageDiv">
                <img class="<?php echo $v2; ?>"  src="../<?php echo $v1; ?>" id="ZoomImage"  style="width:100%;">
            </div>

            <div id="ZoomDroppableDiv">
                <div id="ZoomDraggableDiv"></div>
            </div>
        </div>

        <div id="zoom-hover-div" class="h">
            <img src="" alt="" />
        </div>

        <div id="zoom-control-div" class="h">
            <img src="" class="h" alt="" id="zoom-loading-img" />

            <div id="zoom-navigator" class="zoom-nav-outside-black">
                <img src="" alt="" id="nav-image-clear" />
                <div id="NavCtrlBox" class="zoom-nav-red">


                    <div id="nav-ctrl-handle">
                        <img src="" id="nav-image"/>
                    </div>
                </div>
            </div>

            <div id="zoom-nav-tools">
                <div id="zoom-in-div" title="Zoom: acercar">
                    <img src="" alt="" id="zoom-in-img" />
                </div>

                <div id="zoom-track-div" class="zoom-track4"  style="height:0px;">
                    <div id="zoom-handle-div" style="height:0px;">
                        <img src="" alt="" id="zoom-handle-img" />
                    </div>
                </div>

                <div id="zoom-out-div" title="Zoom: alejar">
                    <img src="" id="zoom-out-img" />
                </div>
            </div>
        </div>
    </div>
</BODY>
</HTML>