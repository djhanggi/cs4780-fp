classdef Cluster < handle

    properties

        description

    end

    methods (Static)

        function cluster = mergeClusters(clusters)
            cluster = ClusterNode(clusters);
            cluster.description =  ...
                sprintf('Danceability: %f, Valence: %f, Energy: %f', ...
                cluster.averageDanceability(), cluster.averageValence(), ...
                cluster.averageEnergy());
        end

        function clusters = agglomerate(songs, links)
            nSongs = length(songs);
            clusters = {};
            for s = nSongs:-1:1
                song = songs(s);
                clusters{s} = ClusterLeaf(song);
            end
            for l = 1:length(links)
                cluster1 = clusters{links(l, 1)};
                cluster2 = clusters{links(l, 2)};
                clusters = [clusters {Cluster.mergeClusters({cluster1 cluster2})}];
            end
        end

        function clusterToJSON(songData, method, jsonName, dist)
            if nargin == 3
                dist = Song.distanceMatrix(songData);
            end
            link = linkage(dist, method);
            clusters = Cluster.agglomerate(songData, link);
            fid = fopen(jsonName, 'w');
            fprintf(fid, clusters{end}.outputClusterJSON());
            fclose(fid);
        end

    end

    methods

        function cluster = Cluster(~)
            cluster.description = '';
        end

        function cluster = convert2struct(~)
            cluster = [];
        end

        function nSongs = numberOfSongs(~)
            nSongs = 0;
        end

        function danceability = sumDanceability(~)
            danceability = 0;
        end

        function valence = sumValence(~)
            valence = 0;
        end

        function energy = sumEnergy(~)
            energy = 0;
        end

        function danceability = averageDanceability(self)
            danceability = self.sumDanceability() / self.numberOfSongs();
        end

        function valence = averageValence(self)
            valence = self.sumValence() / self.numberOfSongs();
        end

        function energy = averageEnergy(self)
            energy = self.sumEnergy() / self.numberOfSongs();
        end

        function JSON = outputClusterJSON(self)
           JSON = json.dump(self.convert2struct());
        end

    end

end
