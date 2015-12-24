<div id="sidebar-wrapper">
             <ul class="sidebar-nav">
                <li class="logo ">
                    <a href="dashboard.html" class="db-view">Logo</a>
                    <a href="dashboard.html" class="mob-view">Menu <i class="fa fa-times menu-toggle"></i></a>
                </li>
                <li <?php if( CONTROLLER == 'dashboard' ): ?>class="active"<?php endif; ?> ><a href="<?php echo base_url();?>index.php/dashboard"><span class="icon icon-home"></span> Dashboard</a></li>
                <li <?php if( CONTROLLER == 'screenshots' ): ?>class="active"<?php endif; ?> ><a href="<?php echo base_url();?>index.php/screenshots"><span class="icon icon-camera"></span> Screenshots</a></li>
                <li <?php if( CONTROLLER == 'analytics' ): ?>class="active"<?php endif; ?> ><a href="<?php echo base_url();?>index.php/analytics"><span class="icon icon-stats-dots"></span> Analytics</a></li>
                <li <?php if( CONTROLLER == 'restrictions' ): ?>class="active"<?php endif; ?> ><a href="<?php echo base_url();?>index.php/restrictions"><span class="icon icon-warning"></span> Restrictions</a></li>
                <li <?php if( CONTROLLER == 'rules' ): ?>class="active"<?php endif; ?> ><a href="<?php echo base_url();?>index.php/rules"><span class="icon icon-file-text2"></span> Rules</a></li>
                <li <?php if( CONTROLLER == 'category' ): ?>class="active"<?php endif; ?> ><a href="<?php echo base_url();?>index.php/category"><span class="icon icon-price-tag"></span> Category</a></li>
                <li <?php if( CONTROLLER == 'settings' ): ?>class="active"<?php endif; ?> ><a href="<?php echo base_url();?>index.php/settings"><span class="icon icon-cog"></span> Settings</a></li>
                <li <?php if( CONTROLLER == 'support' ): ?>class="active"<?php endif; ?> ><a href="http://www.sambakkersupport.com/" target="__blank"><span class="icon icon-lifebuoy"></span> Support</a></li>
                <li><a href="#"><span class="icon icon-exit"></span> Logout</a></li>
            </ul>
        </div> 