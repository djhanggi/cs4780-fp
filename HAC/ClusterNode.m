classdef ClusterNode < Cluster

    properties

        subclusters

    end

    methods

        function node = ClusterNode(subclusters)
            node.subclusters = subclusters;
        end

        function cluster = convert2struct(self)
            for s = length(self.subclusters):-1:1
                children{s} = self.subclusters{s}.convert2struct();
            end
            cluster = struct('name', self.description, 'children', {children});
        end

        function nSongs = numberOfSongs(self)
            nSongs = 0;
            for sc = self.subclusters
                nSongs = nSongs + sc{1}.numberOfSongs();
            end
        end

        function danceability = sumDanceability(self)
            danceability = 0;
            for sc = self.subclusters
                danceability = danceability + sc{1}.sumDanceability();
            end
        end

        function valence = sumValence(self)
            valence = 0;
            for sc = self.subclusters
                valence = valence + sc{1}.sumValence();
            end
        end

        function energy = sumEnergy(self)
            energy = 0;
            for sc = self.subclusters
                energy = energy + sc{1}.sumEnergy();
            end
        end

        function JSON = outputClusterJSON(self)
            JSON = json.dump(self.convert2struct());
        end

    end

end
