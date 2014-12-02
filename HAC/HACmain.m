addpath matlab-json/
json.startup

songData = SongParser.parseSongData('../DataParsing/csv/all_songs-modified.csv');

dist = Song.distanceMatrix(songData);
squareDist = squareform(dist);

Cluster.clusterToJSON(songData, 'single', 'all-songs-clustering-single.json', squareDist);
Cluster.clusterToJSON(songData, 'complete', 'all-songs-clustering-complete.json', squareDist);
Cluster.clusterToJSON(songData, 'average', 'all-songs-clustering-average.json', squareDist);
