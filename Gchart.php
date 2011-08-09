<?php

require_once 'gchart/visualgraph.php';

class Gchart
{
    //private $rows;
    //private $cols;
    /**
     *this will draw out the chart for you
     * @param string $chart_type chart type you wat to use
     * @param string $title title of the chart
     * @param array $gData Data for the chart to use
     */
    public function draw($chart_type, $title='', $gData='', $yaxis ='',$xaxis='')
    {
        $data = new visualgraph($title,$yaxis,$xaxis);
        
        //column details
        $cols = $this->getCols($gData);
        for($i=0; $i < count($this->getCols($gData)); $i++)
        {
            $data->addColumn($cols[$i][0], $cols[$i][1]);
        }
        //row details
        $rows = $this->getRows($gData);
        for($i=0; $i < count($rows); $i++)
        {
            $data->addRow($rows[$i]);
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
  
     
     
}
?>