classdef Cluster < handle
    
    properties
        
        subclusters
        data
        description
        
    end
    
    methods (Static)
        
        function cluster = mergeClusters(cluster1, cluster2)
            if nargin == 2
                cluster = Cluster([cluster1 cluster2], '');
                cluster.description = '';
                %                     sprintf('Danceability: %f, Valence: %f, Energy: %f', ...
                %                     cluster.averageDanceability(), cluster.averageValence(), ...
                %                     cluster.averageEnergy());
            end
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
                clusters = [clusters Cluster.mergeClusters(cluster1, cluster2)];
            end
        end
        
        function clusterToJSON(songData, method, jsonName, dist)
            if nargin == 3
                dist = Song.distanceMatrix(songData);
            end
            link = linkage(dist, method);
            clusters = Cluster.agglomerate(songData, link);
            fid = fopen(jsonName, 'w');
            fprintf(fid, clusters(end).outputClusterJSON());
            fclose(fid);
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
                        cluster.data = [cluster.data c.data];
                    end
                end
                cluster.description = description;
            end
        end
        
        function cluster = convert2struct(self)
            if isempty(self.subclusters)
                cluster = struct('name', self.description);
            else
                for s = length(self.subclusters):-1:1
                    children{s} = self.subclusters(s).convert2struct();
                end
                cluster = struct('name', self.description, 'children', children);
            end
        end
        
        function danceability = averageDanceability(self)
            danceability = 0;
            for s = self.data
                danceability = danceability + s.features.danceability;
            end
            danceability = danceability / length(self.data);
        end
        
        function valence = averageValence(self)
            valence = 0;
            for s = self.data
                valence = valence + s.features.valence;
            end
            valence = valence / length(self.data);
        end
        
        function energy = averageEnergy(self)
            energy = 0;
            for s = self.data
                energy = energy + s.features.energy;
            end
            energy = energy / length(self.data);
        end
        
        function json = outputClusterJSON(self)
            json = savejson(self.convert2struct());
        end
        
    end
    
end
