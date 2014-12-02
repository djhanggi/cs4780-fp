classdef ClusterLeaf < Cluster

    properties

        song

    end

    methods

        function leaf = ClusterLeaf(song)
            leaf.song = song;
            leaf.description = song.description();
        end

        function cluster = convert2struct(self)
            cluster = struct('name', self.description);
        end

        function nSongs = numberOfSongs(~)
            nSongs = 1;
        end

        function danceability = sumDanceability(self)
            danceability = self.song.features.danceability;
        end

        function valence = sumValence(self)
            valence = self.song.features.valence;
        end

        function energy = sumEnergy(self)
            energy = self.song.features.energy;
        end

        function JSON = outputClusterJSON(self)
            JSON = json.dump(self.convert2struct());
        end

    end

end
