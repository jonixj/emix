function NodesController($scope, $http) {

    var url = function (uri) {
        return 'http://api.emix.dev/' + uri;
    }

    $http.get(url('nodes')).success(function (nodes) {
        $scope.nodes = nodes;
    });

    $scope.nbrOfNodes = function () {
        var count = 0;

        angular.forEach($scope.nodes, function (node) {
            count += node.containers.length;
        })

        return count;
    }
}