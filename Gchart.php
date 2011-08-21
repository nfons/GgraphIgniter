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
     * this will draw out the chart for you you dont need to pass anything in, other than Gdata.
     * if you call the functions setCols and parse_query, then you will be ok to leave Gdata blank as well
     * @param string $chart_type chart type you wat to use
     * @param string $title title of the chart
     * @param array $gData Data for the chart to use
     */
    public function draw($chart_type, $title='', $yaxis ='',$xaxis='',$gData='')
    {
        $data = new visualgraph($title,$yaxis,$xaxis);
        //this is fresh data, the user has not called in setRow and setCol has not been called
        if($this->colsSet == false && $this->rowSet == false)
        {
            if(isset($gData))
            {
                //column details
                $this->cols = $this->getCols($gData);
                for($i=0; $i < count($this->cols); $i++)
                {
                    $data->addColumn($his->cols[$i][0], $$this->cols[$i][1]);
                }
                //row details
                $this->rows = $this->getRows($gData);
                for($i=0; $i < count($this->rows); $i++)
                {
                    $data->addRow($this->rows[$i]);
                }
            }
            else
            {
                die("Draw was not given Data to draw from. please pass in Data or call setCol  and prase_query to set the data");
            }
            
                
        }
        
        else //the user passed in before
        {
           for($i = 0; $i < count($this->cols); $i++)
           {
               $data->addColumn($this->cols[$i][0], $this->cols[$i][1]);
           }
           
           for($i = 0; $i < count($this->rows); $i++)
           {
               $data->addRow($this->rows[$i]);
           }
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
  
     //gets the column lists
     private function getCols($data)
     {
        
         return $data[0];
     }
     
     //gets the rows for the data pass. assuming data is multi-dimentional array
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
           global $s;
           if(count($this->cols) == 0)
           {
               echo "It seems you tried to call parse_query BEFORE you setCols. you need to setCols first";
               die();
           }
           for($i = 0; $i < count($this->cols); $i++)
           {
               if($i == 0)
                $s[$i] ='"'.$row->$limits[$i].'"';
               else
                   $s[$i] = $row->$limits[$i];
           }
           
           $this->rows[$index] = $s;
           $index++;
        }
        
        $this->rowSet = true;
     }
     
     /*
      * this will take a 2 dimentional array and add the columns in 
      */
     public function setCol($col)
     {
         $this->cols = $col;
         $this->colsSet = true;
     }
     
     
     
     
}
?>