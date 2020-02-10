<aside class="main-sidebar">
    <section class="sidebar">
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header" style="text-align: center;color: #F79F1F;letter-spacing: 1px;font-weight: bold;">
                MENU LIST
            </li>
        <?php
        $permission_level = DB::table('users')->where('id', Auth::user()->id)->first();
        //var_dump($permission_level->menu_permitted);
        $permission_id = explode(",", $permission_level->menu_permitted);
        $menus = DB::table('menus')->where('parent_id', '=', 0)->get();
        $j = 0;
        foreach ($menus as $menu) {
            $menus[$j]->sub_menu = DB::table('menus')
                ->whereIn('id', $permission_id)
                ->where('parent_id', $menu->id)
                ->where('sub_id', 0)
                ->orderBy('menu', 'asc')
                ->get();
            $j++;
        }

        foreach ($menus as $menu_data) {
            $i = 0;
            foreach ($menu_data->sub_menu as $item) {
//                    var_dump($item->parent_id);
                $menu_data->sub_menu[$i]->child_menu = DB::table('menus')
//                        ->where('parent_id', $item->parent_id)
                    ->where('sub_id', $item->id)
                    ->whereIn('id', $permission_id)
                    ->orderBy('menu', 'asc')
                    ->get();
                $i++;
                //var_dump($child_menu);
            }
        }
        ?>

        <!-- FILE MENU -->
            <li class="treeview">
                <a href="#"><i class="fa fa-user"></i> <span>USER</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{URL('/change-password')}}"><i class="fa fa-circle-o icon_tree_color"></i> CHANGE PASSWORD</a></li>
                </ul>
            </li>
            <?php
            foreach($menus as $menu){
            if ($menu->menu == 'Settings') {
                $icon = '<i class="fa fa-cogs"></i>';
            } elseif ($menu->menu == 'Operation') {
                $icon = '<i class="fa fa-cubes"></i>';
            } elseif ($menu->menu == 'Report') {
                $icon = '<i class="fa fa-bar-chart"></i>';
            }
            if (count($menu->sub_menu) > 0){ ?>
            <li class="treeview">
                <a href="#">
                    <?php echo $icon; ?><span><?php echo strtoupper($menu->menu); ?> </span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <?php foreach ($menu->sub_menu as $sub){
                    if ($sub->url_link == '#'){ ?>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-circle-o icon_tree_color"></i> <?php echo strtoupper($sub->menu); ?>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <?php foreach ($sub->child_menu as $child_menu) { ?>
                            <li><a href="{{URL::to($child_menu->url_link)}}"><i
                                            class="fa fa-circle-o icon_tree_color"></i><?php echo strtoupper($child_menu->menu); ?>
                                </a></li>
                            <?php  } ?>
                        </ul>
                    </li>
                    <?php }else{ ?>
                    <li>
                        <a href="{{URL::to($sub->url_link)}}"><i
                                    class="fa fa-circle-o icon_tree_color"></i> <?php echo strtoupper($sub->menu) ?>
                        </a>
                    </li>
                    <?php   }
                    } ?>
                </ul>
            </li>
            <?php }
             } ?>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
<!-- Sidebar menu -->