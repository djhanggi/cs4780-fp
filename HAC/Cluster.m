classdef Cluster < handle

  properties
    subclusters
  end

  methods

    function cluster = Cluster(subclusters)
      cluster.subclusters = subclusters;
    end

    function sim = similarity(self, other)
      sim = inf;
    end

    function desc = description(self)
      desc = '';
    end

    function plot(self, color, symbol)

    end

  end

end

classdef ClusterNode < Cluster

  properties
    subclusters
  end

  methods

    function node = ClusterNode(subclusters)
      node.subclusters = subclusters;
    end

  end

end

classdef ClusterLeaf < Cluster

  properties
    datum
  end

  methods

    function leaf = ClusterLeaf(datum)
      leaf.datum = datum;
    end

  end

end
