<?

	/*
	 * Plugin Name: Propeller Manager
	 * Version: 1.0.9
	 * Author: Samuel Woodbridge
	 * Description: This plugin allows you to change your website settings.
	 */

	class PM {

		public $icon;
		public $options;

		public static function get_option($set, $property){

			try {

				$option = get_option('prop_'.$set);

				if(isset($option[$property]) && $option[$property] !== '') {

					return $option[$property];

				} else {

					return false;

				}

			} catch (Exception $e) {}

		}

		public static function print_option($set, $property){

			try {

				$option = get_option('prop_'.$set);

				if(isset($option[$property])) {

					echo $option[$property];

				} else {

					return false;

				}

			} catch (Exception $e) {}

		}

		function __construct() {

			if ( is_admin() ) {

				$this->icon = 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE5LjIuMSwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPgo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkxheWVyXzEiIHhtbG5zOnNrZXRjaD0iaHR0cDovL3d3dy5ib2hlbWlhbmNvZGluZy5jb20vc2tldGNoL25zIgoJIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgMzggMzgiCgkgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgMzggMzg7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4KPHN0eWxlIHR5cGU9InRleHQvY3NzIj4KCS5zdDB7ZmlsbDojMjcyNzI1O30KPC9zdHlsZT4KPHRpdGxlPlNsaWNlIDE8L3RpdGxlPgo8ZGVzYz5DcmVhdGVkIHdpdGggU2tldGNoLjwvZGVzYz4KPGcgaWQ9IlBhZ2UtMV8xXyIgc2tldGNoOnR5cGU9Ik1TUGFnZSI+Cgk8ZyBpZD0icHJvcGVsbGVyIiBza2V0Y2g6dHlwZT0iTVNMYXllckdyb3VwIj4KCQk8ZyBpZD0iUGFnZS0xIiBza2V0Y2g6dHlwZT0iTVNTaGFwZUdyb3VwIj4KCQkJPGcgaWQ9IlByb3BlbGxlciI+CgkJCQk8cGF0aCBpZD0iU2hhcGUiIGNsYXNzPSJzdDAiIGQ9Ik0yMi42LDIuOGwtMy4zLDBsMCwwaC00LjFMOSwzNi4zbDAsMEg5bDAsMGMzLjIsMCw2LjMtMi41LDYuOS01LjdsMCwwbDAuMS0wLjhoMGwwLjItMS4ybDMsMAoJCQkJCWMzLjIsMCw2LjUtMi4zLDctNS4zbDAsMGwyLjUtMTMuNWwwLDBjMC4xLTAuNCwwLjEtMC45LDAuMS0wLjlDMjguOSw1LjUsMjYsMi44LDIyLjYsMi44TDIyLjYsMi44TDIyLjYsMi44eiBNMjAuMiwyNC41CgkJCQkJTDIwLjIsMjQuNWMwLDAsMCwwLjItMC4xLDAuM2MtMC4xLDAuOC0wLjksMS4zLTEuNywxLjNoLTEuN2wzLjgtMjAuOWgxLjFjMC45LDAsMS43LDAuNywxLjcsMS42TDIwLjIsMjQuNUwyMC4yLDI0LjV6Ii8+CgkJCTwvZz4KCQk8L2c+Cgk8L2c+CjwvZz4KPC9zdmc+Cg==';

				add_action( 'admin_menu', [ $this, 'create_menu' ] );
				add_action( 'admin_init', [ $this, 'register_settings' ] );
				add_action( 'admin_init', [ $this, 'define_settings' ] );

			}

		}

		function create_menu() {

			add_menu_page(

				'Propeller Manager',
				'Propeller',
				'administrator',
				'propeller-manager',
				[ $this, 'render_page' ],
				$this->icon, 2

			);

			add_submenu_page(

				'propeller-manager',
				'Venue Settings',
				'Venue Settings',
				'administrator',
				'venue-settings',
				[ $this, 'render_venue_page' ]

			);

			add_submenu_page(

				'propeller-manager',
				'Social Media',
				'Social Media',
				'administrator',
				'social-settings',
				[ $this, 'render_social_page' ]

			);

		}

		function render_social_page() {

			$this->options = get_option( 'prop_social' ); ?>

			<div class="wrap">
				<h1>Propeller Site Manager</h1>
				<form method="post" action="options.php">
					<?
						settings_fields( 'propeller_social' );
						do_settings_sections( 'propeller-social' );
						submit_button();
					?>
				</form>
			</div>

			<?

		}

		function render_venue_page() {

			$this->options = get_option( 'prop_venue' ); ?>

			<div class="wrap">
				<h1>Propeller Site Manager</h1>
				<form method="post" action="options.php">
					<?
						settings_fields( 'propeller_venue' );
						do_settings_sections( 'propeller-venue' );
						submit_button();
					?>
				</form>
			</div>

			<?

		}

		function render_page() {

			$this->options = get_option( 'prop_site' ); ?>

			<div class="wrap">
				<h1>Propeller Site Manager</h1>
				<form method="post" action="options.php">
					<?
						settings_fields( 'propeller_site' );
						do_settings_sections( 'propeller-manager' );
						submit_button();
					?>
				</form>
			</div>

			<?

		}

		function section_text() {

			print 'Enter your site settings below:';

		}

		function register_settings() {

			register_setting(

				'propeller_site',
				'prop_site'

			);

			register_setting(

				'propeller_venue',
				'prop_venue'

			);

			register_setting(

				'propeller_social',
				'prop_social'

			);

		}

		function define_settings() {

			/**
			 * @desc Site Settings
			 */

			add_settings_section(

				'site_settings',
				'Site Settings',
				[ $this, 'print_section_info' ],
				'propeller-manager'

			);

			add_settings_field(

				'id',
				'Site ID',
				[ $this, 'add_field' ],
				'propeller-manager',
				'site_settings',
				[
					'name'    => 'id',
					'type'    => 'number',
					'setting' => 'site',
				]

			);

			add_settings_field(

				'typekit',
				'Typekit ID',
				[ $this, 'add_field' ],
				'propeller-manager',
				'site_settings',
				[
					'name'    => 'typekit',
					'type'    => 'text',
					'setting' => 'site',
				]

			);


			add_settings_field(

				'listID',
				'List ID\'s',
				[ $this, 'add_field' ],
				'propeller-manager',
				'site_settings',
				[
					'name'    => 'listID',
					'type'    => 'text',
					'setting' => 'site',
					'note'    => 'Please <strong>comma separate</strong> different list ID\'s e.g. 1111, 2222',
				]

			);

			add_settings_field(

				'email',
				'Email Address',
				[ $this, 'add_field' ],
				'propeller-manager',
				'site_settings',
				[
					'name'    => 'email',
					'type'    => 'email',
					'setting' => 'site',
				]

			);

			add_settings_field(

				'analytics',
				'Analaytics Codes',
				[ $this, 'add_field' ],
				'propeller-manager',
				'site_settings',
				[
					'name'    => 'analytics',
					'type'    => 'textarea',
					'rows'    => 5,
					'cols'    => 46,
					'setting' => 'site',
					'note'    => 'If this site has multiple analytics codes place <strong>each one on a new line.</strong>',
				]

			);

			add_settings_field(

				'webmaster_html_tag',
				'Webmaster HTML Tag',
				[ $this, 'add_field' ],
				'propeller-manager',
				'site_settings',
				[
					'name'    => 'webmaster_html_tag',
					'type'    => 'textarea',
					'rows'    => 5,
					'cols'    => 46,
					'setting' => 'site',
					'note'    => 'Insert your html tag to verify this site on webmaster tools',
				]

			);
			
			add_settings_field(

				'site_specific_head_elements',
				'Head Elements',
				[ $this, 'add_field' ],
				'propeller-manager',
				'site_settings',
				[
					'name'    => 'site_specific_head_elements',
					'type'    => 'textarea',
					'rows'    => 5,
					'cols'    => 46,
					'setting' => 'site',
					'note'    => 'Insert any site specific head elements here. E.g. Google fonts and/or JS links.',
				]

			);

			/**
			 * @desc Venue Settings
			 */

			add_settings_section(

				'venue_settings',
				'Venue Details',
				[ $this, 'print_section_info' ],
				'propeller-venue'

			);

			add_settings_field(

				'phone',
				'Phone Number',
				[ $this, 'add_field' ],
				'propeller-venue',
				'venue_settings',
				[
					'name'    => 'phone',
					'type'    => 'tel',
					'setting' => 'venue',
				]

			);

			add_settings_field(

				'address',
				'Street Address',
				[ $this, 'add_field' ],
				'propeller-venue',
				'venue_settings',
				[
					'name'    => 'address',
					'type'    => 'textarea',
					'rows'    => 5,
					'cols'    => 46,
					'setting' => 'venue',
				]

			);

			add_settings_field(

				'dmn',
				'Design My Night ID',
				[ $this, 'add_field' ],
				'propeller-venue',
				'venue_settings',
				[
					'name'    => 'dmn',
					'type'    => 'text',
					'setting' => 'venue',
				]

			);

			/**
			 * @desc Social Media Settings
			 */

			add_settings_section(

				'social_settings',
				'Social Media Details',
				[ $this, 'print_section_info' ],
				'propeller-social'

			);

			add_settings_field(

				'instagram',
				'Instagram Username',
				[ $this, 'add_field' ],
				'propeller-social',
				'social_settings',
				[
					'name'    => 'instagram',
					'type'    => 'text',
					'setting' => 'social',
				]

			);

			add_settings_field(

				'instagram_id',
				'Instagram User ID',
				[ $this, 'add_field' ],
				'propeller-social',
				'social_settings',
				[
					'name'    => 'instagram_id',
					'type'    => 'text',
					'setting' => 'social',
				]

			);

			add_settings_field(

				'instagram_token',
				'Instagram Access Token',
				[ $this, 'add_field' ],
				'propeller-social',
				'social_settings',
				[
					'name'    => 'instagram_token',
					'type'    => 'text',
					'setting' => 'social',
				]

			);

			add_settings_field(

				'twitter',
				'Twitter User',
				[ $this, 'add_field' ],
				'propeller-social',
				'social_settings',
				[
					'name'    => 'twitter',
					'type'    => 'text',
					'setting' => 'social',
				]

			);

			add_settings_field(

				'facebook',
				'Facebook User',
				[ $this, 'add_field' ],
				'propeller-social',
				'social_settings',
				[
					'name'    => 'facebook',
					'type'    => 'text',
					'setting' => 'social',
				]

			);

			add_settings_field(

				'pinterest',
				'Pinterest User',
				[ $this, 'add_field' ],
				'propeller-social',
				'social_settings',
				[
					'name'    => 'pinterest',
					'type'    => 'text',
					'setting' => 'social',
				]

			);

		}

		function add_field( array $args ) {

			switch ( $args['type'] ) {

				case 'textarea' :

					printf(

						'<textarea id="' . $args['name'] . '" name="prop_' . $args['setting'] . '[' . $args['name'] . ']" rows="' . $args['rows'] . '" cols="' . $args['cols'] . '">%s</textarea>',
						isset( $this->options[ $args['name'] ] ) ? esc_attr( $this->options[ $args['name'] ] ) : ''

					);

					if ( isset( $args['note'] ) ) {

						print(

							'<p class="description">' . $args['note'] . '</p>'

						);

					}

					break;

				default :

					printf(

						'<input type="' . $args['type'] . '" id="' . $args['name'] . '" name="prop_' . $args['setting'] . '[' . $args['name'] . ']" value="%s" class="regular-text" />',
						isset( $this->options[ $args['name'] ] ) ? esc_attr( $this->options[ $args['name'] ] ) : ''

					);

					if ( isset( $args['note'] ) ) {

						print(

							'<p class="description">' . $args['note'] . '</p>'

						);

					}

					break;

			}

		}

		function print_section_info() {

			print 'Please enter your settings below:';

		}

	}

	new PM;
