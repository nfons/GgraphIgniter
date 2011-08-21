<?php

class visualgraph 
{
    public $data; //the data for the data table
    public $string; //main string
    private $num_cols;
    public $gtitle;
    private $yAxis;
    private $xAxis;
    /**
     * @param string title. title of the graph
     */
    public function visualgraph($title,$y='',$x='')
    {
        $this->xAxis = $x;
        $this->yAxis = $y;
        $this->gtitle = $title;
        $this->string.= '<script type="text/javascript" src="http://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load(\'visualization\', \'1\', {packages: [\'corechart\',\'imagelinechart\']});
    </script>
    <script type="text/javascript">
      function drawVisualization() {';
        
        
        $this->data .= 'var data = new google.visualization.DataTable();';
        $this->num_cells = 0;
    }
    
    public function addData($s)
    {
        $data.='data';
    }
    
    public function setCell($s)
    {
        $size = count($s);
        if($size != $this->num_cols)
        {
            
        }
    }
    /**
     * this actually adds the data. depending on how many columns you have the number of variables will depend
     */
    public function addRow($s)
    {
        if(count($s) != $this->num_cols) //data is too little
        {
            die("There was an error in the argument list provided to addRow. there are ".$this->num_cols." colums, and I got ".count($s));
        }
        else
        {
            $temp = "[";
            foreach($s as $key => $value)
            {
                if($key < count($s)-1) 
                    $temp.=$value.",";
                else //last output
                    $temp .= $value;
            }
            $temp .= "]";
          $this->data.="data.addRow(".$temp."); \n";
        }
    }
    /**
     *this will add i plank rows to the data type. you will need to follow it with setCell calls to fill the 
     * row with information
     * @param integer $i the number of rows you want created.
     */
    public function addRows($i)
    {
        if(is_int($i))
            $this->data .="data.addRows(".$i.");";
        else
            echo "Error. addRows requires an integer";
    }
    
    /**
     *this will add a column to the data type of google. columns contain  
     * @param type $type
     * @param type $val 
     */
    public function addColumn($type, $val)
    {
        $this->data .= "data.addColumn('".$type."','".$val."');";
        $this->num_cols++; //increase the number of cells
    }
    
    
    /*
     * DRAWING.
     */
    
    
    
    public function drawLine()
    {
        //echo 'current data . <br >'.$this->data;
        $this->string .=$this->data;
        $this->string .='new google.visualization.LineChart(document.getElementById(\'visualization\')).
      draw(data, {curveType: "function",
                  width: 500, height: 400,
                  vAxis: {maxValue: 10, title:"'.$this->yAxis.'"},
                  hAxis: {title:"'.$this->xAxis.'"},
                  title: "'.$this->gtitle.'"}
                   );
      }
      

      google.setOnLoadCallback(drawVisualization);
    </script>';
        return $this->string;
    }
    
    public function drawImageLine()
    {
        $this->string .=$this->data;
        $this->string .= "new google.visualization.ImageLineChart(document.getElementById('visualization')).
      draw(data, {title: \"".$this->gtitle."\"});
      }
      google.setOnLoadCallback(drawVisualization);
    </script>";
        
        return $this->string;
    }
    
    /**
     * visual version of the pie chart. interactive
     */
    public function drawPie()
    {
       $this->string .= $this->data;
       $this->string .= "new google.visualization.PieChart(document.getElementById('visualization')).
       draw(data, {title: \"".$this->gtitle."\"}); }
      google.setOnLoadCallback(drawVisualization);
    </script>";
       
       return $this->string;
    }
    /**
     * image version of pie chart.
     */
    public function drawImagePie()
    {
        $this->string .= $this->data;
        $this->string .= " new google.visualization.ImagePieChart(document.getElementById('visualization')).
        draw(data, {title: \"".$this->gtitle."\"}); }
         google.setOnLoadCallback(drawVisualization);
        </script>";
        
        return $this->string;
    }
    
    /**
     * this will draw the bar in interactive format. using javascript
     */
    public function drawBar()
    {
       $this->string .= $this->data;
       $this->string .= "var options = {};
           options.title=\"".$this->gtitle."\";
  // 'bhg' is a horizontal grouped bar chart in the Google Chart API.
  // The grouping is irrelevant here since there is only one numeric column.
  options.cht = 'bvg';
  
  // Add a data range.
  var min = 0;
  var max = 20;
  options.chds = min + ',' + max;

  // Now add data point labels at the end of each bar.

  // Add meters suffix to the labels.
  var meters = 'N** m';

  // Draw labels in pink.
  var color = 'ff3399';

  // Google Chart API needs to know which column to draw the labels on.
  // Here we have one labels column and one data column.
  // The Chart API doesn't see the label column.  From its point of view,
  // the data column is column 0.
  var index = 0;

  // -1 tells Google Chart API to draw a label on all bars.
  var allbars = -1;

  // 10 pixels font size for the labels.
  var fontSize = 10;
 
  // Priority is not so important here, but Google Chart API requires it.
  var priority = 0;

  options.chm = [meters, color, index, allbars, fontSize, priority].join(',');
  options.hAxis = {};
  options.vAxis = {};
  options.hAxis.title = \"".$this->xAxis."\";
  options.vAxis.title = \"".$this->yAxis."\";
  
  // Create and draw the visualization.
  new google.visualization.ColumnChart(document.getElementById('visualization')).
      draw(data,options);
}    
google.setOnLoadCallback(drawVisualization);
  
        </script>";
       
       return $this->string;
    }
    
    /**
     * this function will draw the bar in image format, so that the user can save it
     */
    public function drawImageBar()
    {   $this->string .= $this->data;
    
        $this->string .="
var options = {};
           options.title=\"".$this->gtitle."\";
  // 'bhg' is a horizontal grouped bar chart in the Google Chart API.
  // The grouping is irrelevant here since there is only one numeric column.
  options.cht = 'bvg';

  // Add a data range.
  var min = 0;
  var max = 20;
  options.chds = min + ',' + max;

  // Now add data point labels at the end of each bar.

  // Add meters suffix to the labels.
  var meters = 'N** m';

  // Draw labels in pink.
  var color = 'ff3399';

  // Google Chart API needs to know which column to draw the labels on.
  // Here we have one labels column and one data column.
  // The Chart API doesn't see the label column.  From its point of view,
  // the data column is column 0.
  var index = 0;

  // -1 tells Google Chart API to draw a label on all bars.
  var allbars = -1;

  // 10 pixels font size for the labels.
  var fontSize = 10;
 
  // Priority is not so important here, but Google Chart API requires it.
  var priority = 0;

  options.chm = [meters, color, index, allbars, fontSize, priority].join(',');
  
    new google.visualization.ImageChart(document.getElementById('visualization')).
    draw(data, options);  
    }
    google.setOnLoadCallback(drawVisualization);
  
        </script>";
        
        return $this->string;
    }
    
    
}
?>
