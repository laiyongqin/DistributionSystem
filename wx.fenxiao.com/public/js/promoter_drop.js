$(document).ready(function(){
        var page = 2;
        if(total >= pageSize) {
            $("#promoter_list").dropload({
                domDown : {// 下方DOM
                    domClass   : 'dropload-down',
                    domRefresh : '<div class="dropload-refresh">↑上拉加载更多</div>',
                    domLoad    : '<div class="dropload-load"><span class="loading"></span>加载中...</div>',
                    domNoData  : '<div class="dropload-noData">没有啦╮(╯_╰)╭</div>'
                },
                scrollArea : window,
                loadDownFn : function(me){

                    $.ajax({
                        type: 'GET',
                        url : "/member/member/list/?type=load&page=" + page + '&mid=' + mid + '&smid=' + smid,
                        dataType: 'html',
                        success: function(data){
                            if(data) {
                                //赋值数据
                                $("#promoter_list").append(data);
                                page++;
                            } else {
                                // 锁定
                                me.lock();
                                // 无数据
                                me.noData();
                            }
                            // 每次数据加载完，必须重置
                            me.resetload();
                        },
                        error: function(xhr, type){
                            // 即使加载出错，也得重置
                            me.resetload();
                        }
                    });
                }
            });
        }
})