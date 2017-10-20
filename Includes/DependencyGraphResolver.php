<?php
// Create a dependency graph of database tables
// Resolve the graph to get the order by which
// tables or entities must be added to the database
class DependencyGraphResolver
{
    public function GetDependencyOrder($dbSchema)
    {
        $graph = $this->BuildGraph($dbSchema);
        return $this->ResolveDependency($graph);
    }

    private function BuildGraph($dbSchema)
    {
        $graph = [];

        // get schema keys
        foreach ($dbSchema as $key=>$value)
        {
            if (!isset($graph[$key])) {
                $graph[$key] = [];
            } 

            $edges = $value['fkey'];
            if ($edges != null)
            {
                foreach($edges as $edge)
                {
                    $graph[$key][] = $edge;
                }
            }
        }

        return $graph;
    }

    private function ResolveDependency($graph)
    {
        $expectedKeys = count((array) $graph);
        $dep = [];
        $lastCount = 0;

        while (count($dep) < $expectedKeys)
        {
            // prevent infinite loops
            $lastCount = count($dep);

            foreach ($graph as $node=>$nd)
            {
                // if the node is already in the dependency
                // array then skip
                if (!in_array($node, $dep))
                {
                    // if the node has no dependencies then include
                    if (count($nd) == 0)
                    {
                        $dep[] = $node;
                    }
                    else
                    {
                        // if node has all dependencies allready in the
                        // array then add to array.
                        $all = true;
                        foreach($nd as $ndv)
                        {
                            if (!in_array($ndv, $dep))
                            {
                                $all = false;
                                break;
                            }
                        }
        
                        if ($all)
                        {
                            $dep[] = $node;
                        }
                    }
                }
            }

            // if no change in dependency array then throw
            if ($lastCount == count($dep))
            {
                throw new Exception("Cannot determine dependency graph");
            }
            
        }
        return $dep;
    }
}

?>