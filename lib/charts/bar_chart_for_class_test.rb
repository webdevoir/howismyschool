module Charts
  module BarChartForClassTest

    def class_test_toppers
      @js_chart["JSChart"]["datasets"][0]["data"]  =
        @class_test.get_toppers_array_for_bar_chart

      respond_to do |format|
        format.json { render json: @js_chart }
      end
    end

    def class_test_lowest_scorers
      @js_chart["JSChart"]["datasets"][0]["data"]  =
        @class_test.get_lowest_scorers_array_for_bar_chart

      respond_to do |format|
        format.json { render json: @js_chart }
      end
    end

    def class_test_subjectwise_toppers
      @js_chart["JSChart"]["datasets"][0]["data"]  =
        @class_test.get_subjectwise_toppers_array_for_bar_chart

      respond_to do |format|
        format.json { render json: @js_chart }
      end
    end

    def class_test_subjectwise_lowest_scorers
      @js_chart["JSChart"]["datasets"][0]["data"]  =
        @class_test.get_subjectwise_lowest_scorers_array_for_bar_chart

      respond_to do |format|
        format.json { render json: @js_chart }
      end
    end

    protected

    def set_common_chart_data_for_class_test_charts
      chart_type = params[:chart_type] || DEFAULT_CHART_TYPE
      @js_chart   = default_chart_hash(chart_type)
      @class_test = ClassTest.find params[:id]
    end

  end
end