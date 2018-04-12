<div id="sidebar" class="sidebar                  responsive                    ace-save-state">
    <script type="text/javascript">
        try {
            ace.settings.loadState('sidebar')
        } catch (e) {}

    </script>

    <div class="sidebar-shortcuts" id="sidebar-shortcuts">
        <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
            <button class="btn btn-success">
                <i class="ace-icon fa fa-signal"></i>
            </button>

            <button class="btn btn-info">
                <i class="ace-icon fa fa-pencil"></i>
            </button>

            <button class="btn btn-warning">
                <i class="ace-icon fa fa-users"></i>
            </button>

            <button class="btn btn-danger">
                <i class="ace-icon fa fa-cogs"></i>
            </button>
        </div>

        <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
            <span class="btn btn-success"></span>

            <span class="btn btn-info"></span>

            <span class="btn btn-warning"></span>

            <span class="btn btn-danger"></span>
        </div>
    </div>
    <!-- /.sidebar-shortcuts -->

    <ul class="nav nav-list">
        <?php
            $siderbar_config = require(BASE_PATH . '/siderbar.php');
            
            foreach ($siderbar_config as $item) {
                if ($item["realData"] == true) {
                    echo setupFirstLi($item);
                } else {

                    echo '<li class="">';
                    echo '<a href="'. $item["redirect"] .'" class="dropdown-toggle">';
                    echo '<i class="menu-icon fa '. $item["icon"].'"></i>';
                    echo '<span class="menu-text">'. $item["title"] .'</span>';
                    echo '<b class="arrow fa fa-angle-down"></b>';
                    echo '</a>';
                    echo '<b class="arrow"></b>';
                    echo '<ul class="submenu">';

                    if (count($item["data"]) > 0) {
                        foreach ($item["data"] as $data) {
                            echo '<li class="">';
                            echo '<a href="'. $data["redirect"] .'">';
                            echo '<i class="menu-icon fa fa-caret-right"></i>';
                            echo $data["title"];
                            echo '</a>';
                            echo '<b class="arrow"></b>';
                            echo '</li>';
                        }
                    }
                    echo '</ul>';
                    echo '</li>';
                }
            }

            function setupFirstLi($data)
            {
                return '
                <li class="">
                <a href="'. $data["redirect"] . '">
                <i class="menu-icon fa '. $data["icon"] .'"></i>
                <span class="menu-text">'. $data["title"] .'</span>
                </a>
                
                <b class="arrow"></b>
                </li>
                ';
            }
        ?>
    </ul>
    <!-- /.nav-list -->

    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
        <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left"
            data-icon2="ace-icon fa fa-angle-double-right"></i>
    </div>
</div>
