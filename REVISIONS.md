# Revisions

-- possibly move functionality of Grid::applyRulesToFindNewValue()
into some kind of Cell class, if simplicity can be preserved. 
May also be a good home for Grid::calculateNeighborFacts(), 
but that may introduce complications as Cells 
do not inherently keep track of their neighbors...

--get color-coding in CLI output to increase human readability

--move exception stack in Grid::__construct() into its own validation class

--implement a REAL testing tool (phpunit I miss you! :(( ... )