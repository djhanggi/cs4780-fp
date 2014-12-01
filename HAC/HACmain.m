addpath HAC/jsonlab

songData = SongParser.parseSongData('DataParsing\csv\all_songs-modified.csv');
songData = songData(1:300);

dist = zeros(length(songData));
for r = 1:length(songData)
    for c = r+1:length(songData)
        dist(r, c) = Song.distance(songData(r), songData(c));
        dist(c, r) = Song.distance(songData(r), songData(c));
    end
end

squareDist = squareform(dist);
linkSingle = linkage(squareDist, 'single');
%linkComple = linkage(squareDist, 'complete');
%linkAverag = linkage(squareDist, 'average');
%linkCentro = linkage(squareDist, 'centroid');

clustersSingle = Cluster.agglomerate(songData, linkSingle);
% clustersComple = Cluster.agglomerate(songData, linkComple);
% clustersAverag = Cluster.agglomerate(songData, linkAverag);
% clustersCentro = Cluster.agglomerate(songData, linkCentro);

fid = fopen('all-songs-clustering-single.json', 'w');
fprintf(fid, clustersSingle(end).outputClusterJSON());
fclose(fid);
