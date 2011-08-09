<?php

require_once 'gchart/visualgraph.php';
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
        for($i=0; $i < count($gData[0]); $i++)
        {
            $data->addColumn($gData[0][$i][0], $gData[0][$i][1]);
        }
        
        for($i=0; $i < count($gData[1]); $i++)
        {
            $data->addRow($gData[1][$i]);
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
        
        return $return;
                 
     }
  
     private function getCols($data)
     {
         //$this->cols = $data[0];
         return $data[0];
     }
     
     private function getRows($data)
     {
         return $data[1];
     }
  
}
?>
