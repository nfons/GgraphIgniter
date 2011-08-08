<?php

class visualgraph 
{
    public $data; //the data for the data table
    public $string; //main string
    private $num_cols;
    
    public function visualgraph()
    {
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
    
    public function drawLine()
    {
        //echo 'current data . <br >'.$this->data;
        $this->string .=$this->data;
        $this->string .='new google.visualization.LineChart(document.getElementById(\'visualization\')).
      draw(data, {curveType: "function",
                  width: 500, height: 400,
                  vAxis: {maxValue: 10}}
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
      draw(data, null);
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
        
    }
    /**
     * image version of pie chart.
     */
    public function drawImagePie()
    {
        $this->string = " new google.visualization.ImagePieChart(document.getElementById('visualization')).
      draw(data, null);";
    }
    
    /**
     * this will draw the bar in interactive format. using javascript
     */
    public function drawBar()
    {
       $this; 
    }
    
    /**
     * this function will draw the bar in image format, so that the user can save it
     */
    public function drawImageBar()
    {
        $this->string .="new google.visualization.ImageChart(document.getElementById('visualization')).
    draw(data, options);  ";
    }
}
?>
