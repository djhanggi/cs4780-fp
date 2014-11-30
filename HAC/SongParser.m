classdef SongParser < handle
    
    methods (Static)
        
        function songData = parseSongData(songDataFile)
            songTable = readtable(songDataFile);
            songCellA = table2cell(songTable);
            songData = Song.empty;
            [nSongs, ~] = size(songCellA);
            for s = nSongs:-1:1
                title = songCellA{s,1};
                artist_name = songCellA{s,2};
                features = SongParser.convertFeatures(cell2mat(songCellA(s,3:end)));
                songData(s) = Song(title, artist_name, features);
            end
        end
        
        function features = convertFeatures(rawFeatures)
            key = rawFeatures(1);
            energy = rawFeatures(2);
            liveness = rawFeatures(3);
            tempo = rawFeatures(4);
            speechiness = rawFeatures(5);
            acousticness = rawFeatures(6);
            instrumentalness = rawFeatures(7);
            mode = rawFeatures(8);
            time_signature = rawFeatures(9);
            duration = rawFeatures(10);
            loudness = rawFeatures(11);
            valence = rawFeatures(12);
            danceability = rawFeatures(13);
            features = struct('key', key, 'energy', energy, 'liveness', liveness, ...
                'tempo', tempo, 'speechiness', speechiness, 'acousticness', ...
                acousticness, 'instrumentalness', instrumentalness, ...
                'mode', mode', 'time_signature', time_signature, 'duration', ...
                duration, 'loudness', loudness, 'valence', valence, ...
                'danceability', danceability);
        end
        
    end
    
end