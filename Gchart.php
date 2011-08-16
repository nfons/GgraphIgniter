<?php

require_once 'gchart/visualgraph.php';

class Gchart
{
    private $query;
    private $rows;
    private $cols;
    private $colsSet;
    private $rowSet;
    
    function Gchart()
    {
        $this->colsSet = false;
        $this->rowSet = false;
    }
    /**
     *this will draw out the chart for you
     * @param string $chart_type chart type you wat to use
     * @param string $title title of the chart
     * @param array $gData Data for the chart to use
     */
    public function draw($chart_type, $title='', $yaxis ='',$xaxis='',$gData='')
    {
        $data = new visualgraph($title,$yaxis,$xaxis);
        //this is fresh data, the user has not called in setRow and setCol has not been called
        if((!$this->colsSet && !$this->rowSet) && isset ($gData))
        {
            //column details
            $cols = $this->getCols($gData);
            for($i=0; $i < count($cols); $i++)
            {
                $data->addColumn($cols[$i][0], $cols[$i][1]);
            }
            //row details
            $rows = $this->getRows($gData);
            for($i=0; $i < count($rows); $i++)
            {
                $data->addRow($rows[$i]);
            }
        }
        
        else
        {
            die("Error. gData corrupted");
        }

        $return;
        switch($chart_type)
        {
            case "line":
                $return = $data->drawLine();
                break;
            case "pie":
                  $return = $data->drawPie();
                   break;
             case "bar":
                 $return = $data->drawBar();
                 break;
             case "imageline":
                 $return = $data->drawImageLine();
                 break;
             case "imagepie":
                 $return = $data->drawImagePie();
                 break;
             default:
                 $return = $data->drawImageBar();
                 break;
        }
        
        //add the instantiation
        $return .='<div id="visualization" style="width: 500px; height: 400px;"></div>';
        return $return;
                 
     }
  
     
     private function getCols($data)
     {
        
         return $data[0];
     }
     
     private function getRows($data)
     {
         return $data[1];
     }
     /**
      * Here is how the parsing is done: it will parse COLUMNS,add that data to the google table unless there is a limit implied to it.
      * @param type $query the query of mysql data
      * @param type $limits Array. this will check to see which columns of data you want.
      */
     public function parse_query($query,$limits='')
     {
  
        $index = 0;
        foreach($query->result() as $row)
        {
           $s;
           for($i = 0; $i < count($this->cols); $i++)
           {
               $s[$i] = $row->$limits[$i];
               echo $limits[$i];
           }
           
           //$this->rows[$index] = $s;
           $index++;
        }
        
        $this->rowSet = true;
     }
     
     public function setCol($col)
     {
         $this->cols = $col;
         $this->colsSet = true;
     }
     
     
     
     
}
?>