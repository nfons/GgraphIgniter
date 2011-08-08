<?php

class visualgraph 
{
    public $data; //the data for the data table
    public $string; //main string
    
    public function visualgraph()
    {
        $this->string.= '<script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script type="text/javascript">';
        $this->data .= 'var data = new google.visualization.DataTable();';
    }
    
    public function addData($s)
    {
        $data.='data';
    }
    
    public function setCell($s)
    {
        
    }
    /**
     * this actually adds the data. depending on how many columns you have the number of variables will depend
     */
    public function addRow($s)
    {
        
    }
    
    /**
     *this will add a column to the data type of google. columns contain  
     * @param type $type
     * @param type $val 
     */
    public function addColumn($type, $val)
    {
        $this->data .= "data.addColumn('".$type."','".$val."');";
    }
    
    public function drawLine()
    {
        
    }
    
    public function drawImageLine()
    {
        $this->string .= "new google.visualization.ImageLineChart(document.getElementById('visualization')).
      draw(data, null);";
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
