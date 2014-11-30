classdef Cluster < handle
    
    properties
        
        subclusters
        data
        description
        
    end
    
    methods (Static)
        
        function cluster = mergeClusters(cluster1, cluster2, description)
            cluster = Cluster([cluster1 cluster2], description);
        end
        
        function clusters = agglomerate(songs, links)
            nSongs = length(songs);
            clusters = Cluster.empty;
            for s = nSongs:-1:1
                song = songs(s);
                clusters(s) = Cluster(song, song.description());
            end
            for l = 1:length(links)
                cluster1 = clusters(links(l, 1));
                cluster2 = clusters(links(l, 2));
                clusters = [clusters Cluster.mergeClusters(cluster1, cluster2, l)];
            end
            
        end
        
    end
    
    methods
        
        function cluster = Cluster(subclusters, description)
            if nargin == 2
                if length(subclusters) == 1
                    cluster.subclusters = [];
                    cluster.data = subclusters;
                else
                    cluster.subclusters = subclusters;
                    for c = subclusters
                        cluster.data = [cluster.data subclusters.data];
                    end
                end
                cluster.description = description;
            end
        end
        
        function cluster = convert2struct(self)
            children = [];
            for s = length(self.subclusters):-1:1
                children(s) = self.subclusters(s).convert2struct();
            end
            cluster = struct('name', self.description, 'children', children);
        end
        
        function json = outputClusterJSON(self)
            json = savejson(self.convert2struct());
        end
        
    end
    
end
