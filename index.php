<?php

class Push_swap
{
    public $la;
    public $lb;

    public function __construct($argument)
    {
        $this->argument = $argument;
        $this->la = $this->getAllNumber($this->argument);
        $this->lb = [];
        $this->pushLb();
        $this->pushLa();
    }

    public function getAllNumber($n)
    {
        $value = [];

        for ($i = 0; $i < count($n); $i++) {
                if (is_numeric($n[$i])) {
                        array_push($value, $n[$i]);
                    }
            }

        return $value;
    }

    public function sa()
    {
        if (count($this->la) > 1) {
                $temp = $this->la[0];
                $this->la[0] = $this->la[1];
                $this->la[1] = $temp;
            } else {
                return false;
            }
    }

    public function sb()
    {
        if (count($this->lb) > 1) {
                $temp = $this->lb[0];
                $this->lb[0] = $this->lb[1];
                $this->lb[1] = $temp;
            } else {
                return false;
            }
    }

    public function sc()
    {
        if (count($this->la) > 1 && count($this->lb) > 1) {
                $this->sa();
                $this->sb();
            } else {
                return false;
            }
    }

    public function pa()
    {
        if (isset($this->lb[0])) {
                array_unshift($this->la, $this->lb[0]);
                $f = array_shift($this->lb);

            } else {
                return false;
            }

            return "pa ";
    }
        
    public function pb()
    {
        if (isset($this->la[0])) {
                array_unshift($this->lb, $this->la[0]);
                $f = array_shift($this->la);
            } else {
                return false;
            }
            return "pb ";

    }

    public function ra()
    {
        $rotate = array_shift($this->la);
        array_push($this->la, $rotate);
        return "ra ";
    }

    public function rb()
    {
        $rotate = array_shift($this->lb);
        array_push($this->lb, $rotate);
    }

    public function rr()
    {
        $this->ra();
        $this->rb();
    }


    public function rra()
    {
        $last = array_pop($this->la);
        array_unshift($this->la, $last);
        return "rra";
    }

    public function rrb()
    {
        $last = array_pop($this->lb);
        array_unshift($this->lb, $last);
    }

    public function rrr()
    {
        $this->rra();
        $this->rrb();
    }

    public function getMinIndex($tab)
    {
        $index = 0;
        for ($i = 0; $i < count($tab); $i++) {
                if ($tab[$i] < $tab[$index]) 
                {
                        $index = $i;
                }
            }
        return $tab[$index];
    }

    public function get($min)
    {
        $key = array_search($min, $this->la);
        $m = max(array_keys($this->la));
        $midKey = $m / 2;

        if($key > $midKey)
        {
            echo $this->rra();
        }
        else
        {
            echo $this->ra();
        }
        echo " ";
    }

    public function pushLb()
    {
        while(!empty($this->la)) 
        {
            $min = $this->getMinIndex($this->la);
            while ($this->la[0] != $min) 
            {
                $this->get($min);
                //echo $this->ra();

            }

            while($this->la[0] == $min)
            {
                echo $this->pb();
                if(count($this->la) == 0)
                {
                    return 0;
                }
            }
        }
    }

    public function pushLa()
    {
        var_dump($this->lb);
        while(count($this->lb) != 0)
        {
            echo $this->pa();
        }
        var_dump($this->la);
    }
}

new Push_swap($argv);
?>