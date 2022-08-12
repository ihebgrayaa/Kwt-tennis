<?php



if (!class_exists('WP_List_Table')) {

    require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}



class Kuwait_List_Table extends WP_List_Table

{

    /**

     * Prepare the items for the table to process

     *

     * @return Void

     */

    public function prepare_items()

    {

        $columns = $this->get_columns();

        $hidden = $this->get_hidden_columns();

        $sortable = $this->get_sortable_columns();



        $data = $this->table_data();

        usort($data, array(&$this, 'sort_data'));



        $perPage = 6;

        $currentPage = $this->get_pagenum();

        $totalItems = count($data);



        $this->set_pagination_args(array(

            'total_items' => $totalItems,

            'per_page'    => $perPage

        ));



        $data = array_slice($data, (($currentPage - 1) * $perPage), $perPage);



        $this->_column_headers = array($columns, $hidden, $sortable);

        $this->items = $data;
    }

    /**

     * Override the parent columns method. Defines the columns to use in your listing table

     *

     * @return Array

     */

    public function get_columns()

    {

        $columns = array(

            'color'         => 'Color',

            'title'         => 'Title',

            'coach'         => 'Coach',

            'types'         => 'Types',

            'groups'        => 'Groups',

            'levels'        => 'Levels',

            'duration'      => 'Duration',

            'status'        => 'Status',

        );



        return $columns;
    }

    /**

     * Define which columns are hidden

     *

     * @return Array

     */

    public function get_hidden_columns()

    {

        return array();
    }



    /**

     * Define the sortable columns

     *

     * @return Array

     */

    public function get_sortable_columns()

    {

        return array('title' => array('title', false), 
        'coach' => array('coach', false),
        'types' => array('types', false),
        'groups' => array('groups', false),
        'levels' => array('levels', false),
    );
    }

    /**

     * Get the table data

     *

     * @return Array

     */

    private function table_data()

    {

        $data = array();

        $user = wp_get_current_user();

        $roles = (array) $user->roles;



        if ($roles[0] === "administrator") {

            $args = array(

                'post_type' => 'programs',

                'post_status' => 'publish',

                'posts_per_page' => -1

            );

            $posts = get_posts($args);

            foreach ($posts as $post) {

                $ID = $post->ID;

                $dateStart = get_field('date_start', $ID);

                $dateEnd = get_field('date_end', $ID);

                $firstDate  = new DateTime($dateStart);

                $secondDate = new DateTime($dateEnd);

                $color = get_field('agenda_color', $ID);

                $coach = get_userdata(get_field('coach', $ID));

                $coachName = $coach->user_login;

                $groups = get_the_terms($ID, 'groups');

                $levels = get_the_terms($ID, 'levels');

                $types = get_the_terms($ID, 'programs_type');

                $intvl = $firstDate->diff($secondDate);

                $now = new DateTime();

                $bookStart = DateTime::createFromFormat('m/d/Y g:i a', $dateStart)->format('j M Y/ g:i a');

                $bookEnd = DateTime::createFromFormat('m/d/Y g:i a', $dateEnd)->format('j M Y/ g:i a');



                if ($now->format('m/d/Y') > $dateEnd) {

                    $status = '<span class="KWT-status closed">Closed</span>';
                
                } else {

                    $status = '<span class="KWT-status opened">Opened</label>';
                }

                $data[] = array(

                    'color'         => '<span style="background-color:' . $color . '; height:20px; width:20px ; display:block"></span>',

                    'title'         => '<h4 class="KWT_post_title"><a href="' . get_edit_post_link($ID) . '">' . $post->post_title . '</a><span class="KWT_post_ID">(ID: ' . $ID . ')</span></h4>',

                    'coach'         => '<div style="cursor:pointer">' . $coachName . '</div>',

                    'types'        => '<div style="cursor:pointer">' . $types[0]->name . '</div>',

                    'groups'        => '<div style="cursor:pointer">' . $groups[0]->name . '</div>',

                    'levels'        => '<div style="cursor:pointer">' . $levels[0]->name . '</div>',

                    'duration'      => '<div class="program-date"><label class="start" style="color:#5fce19"><small style="color:#000">Start: </small>' . $bookStart . '</label><label class="end" style="color:#ff1563"><small style="color:#000">End: </small>' . $bookEnd . '</label><label class="interval"><i>' . $intvl->days . " days " . '</i></label></div>',

                    'status'        =>  $status

                );
            };



            return $data;
        }
    }



    /**

     * Define what data to show on each column of the table

     *

     * @param  Array $item        Data

     * @param  String $column_name - Current column name

     *

     * @return Mixed

     */

    public function column_default($item, $column_name)

    {

        switch ($column_name) {

            case 'color':

            case 'title':

            case 'coach':

            case 'types':

            case 'groups':

            case 'levels':

            case 'duration':

            case 'status':

                return $item[$column_name];



            default:

                return print_r($item, true);
        }
    }



    /**

     * Allows you to sort the data by the variables set in the $_GET

     *

     * @return Mixed

     */

    private function sort_data($a, $b)

    {

        // Set defaults

        $orderby = 'title';

        $order = 'asc';



        // If orderby is set, use this as the sort column

        if (!empty($_GET['orderby'])) {

            $orderby = $_GET['orderby'];
        }



        // If order is set use this as the order

        if (!empty($_GET['order'])) {

            $order = $_GET['order'];
        }





        $result = strcmp($a[$orderby], $b[$orderby]);



        if ($order === 'asc') {

            return $result;
        }



        return -$result;
    }
}
