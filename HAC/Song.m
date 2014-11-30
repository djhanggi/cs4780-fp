classdef Song < handle
    
    properties
        
        title
        artist_name
        features
        
    end
    
    methods (Static)
        
        function dist = distance(song1, song2)
            X = song1.veenaTransformation() - song2.veenaTransformation();
            Y = song1.features.valence - song2.features.valence;
            dist = sqrt(X^2 + Y^2);
        end
        
    end
    
    methods
        
        function song = Song(title, artist_name, features)
            if nargin == 3
                song.title = title;
                song.artist_name = artist_name;
                song.features = features;
            end
        end
        
        function measure = veenaTransformation(self)
            vale = self.features.valence;
            temp = self.features.tempo;
            ener = self.features.energy;
            loud = self.features.loudness;
            acou = self.features.acousticness;
            live = self.features.liveness;
            spee = self.features.speechiness;
            inst = self.features.instrumentalness;
            measure = ...
                -(3.279225 * 10^-6) * vale * temp^2 + ...
                -(8.160651 * 10^-4) * ener * loud^2 + ...
                +(3.218223 * 10^-1) * acou * ener^2 + ...
                -(3.279225 * 10^-6) * live * spee^1 + ...
                +(3.793979 * 10^-4) * temp * ener^1 + ...
                -(7.492498 * 10^-3) * loud * acou^1 + ...
                +(7.001209 * 10^-2) * inst * vale^1 + ...
                -(6.132415 * 10^-4) * vale * loud^1 + ...
                +(1.359087 * 10^-2) * ener * loud^1 * vale^2;
        end
        
        function desc = description(self)
            desc = sprintf('[%s] by %s', self.title, self.artist_name);
        end
        
    end
    
end