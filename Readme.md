this is a attempt at converting google graph API to work with Codeigniter.
<br />for codeigniter please visit http://codeigniter.com.
<br />for google graph code, visit http://code.google.com/apis/chart/

its not the cleanest thing in the world...but it gets the job done for what its coded for.<br/>
regular implementation of Google charts is a pain. i made it a little bit more dynamic, so that you can use charts with data from 
mysql databases or any type of data storage mechanism (like XML parsing)
<br />
you will need to supply the column/row data (i suggest running queries to add the data)
and then the draw() will create the proper chart you want.
<b>Examples: </b>
<hr />
getting data from a mysql query in CI:
                $this->load->library('gchart');
                $this->load->database(); //load the database
                $query = $this->db->get('data'); //
                $rows;
                $i = 0;
                foreach($query->result() as $row)
                {
                    $s;
                    $s[0] = "'".$row->name."'";
                    $s[1] = $row->cats;
                    $s[2] = $row->dogs;
                    $rows[$i] = $s;
                    $i++;
                }
                /*
 please note that, the number of elements in $s is dependent on how many columns/data you want to have. in this example,
 i want to graph how many Cats and Dogs each person has.                 
*/
                $cols; 
                $cols[0][0]="string";
                $cols[0][1] ="x";
                $cols[1][0] = "number";
                $cols[1][1]="cats";
                $cols[2][0] ="number";
                $cols[2][1] ="dogs";

                /*
this part is important...this is what tells google charts, which $s[index] is what kind of data. this will always be a doube array. let this be visualized as such:
$cols[INDEX OF $S ][type of data] and $cols[INDEX of $S][What the data is]
so for example, $cols[0][0] and $cols[0][1] tells google data: "the data is 0th column, in each row, is a "string" and this string is what "x axis" is.
$cols[1][0] and [1][1] is basically, 1st column on each row is a number, and it is the number of cats.
*/

                $gd[0] = $cols;
                $gd[1] = $rows;
                $data['chart'] =$this->gchart->draw("line","hello world",$gd,"y axis","x axis"); //draw(TYPE OF CHART, TITLE, DATA, yaxis title, x axis title )
<i>
please send email for any question/comments or suggestions
email me at natefonseka dot com
</i>
