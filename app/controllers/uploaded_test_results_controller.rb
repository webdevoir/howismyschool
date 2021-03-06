class UploadedTestResultsController < ApplicationController
  before_action :authenticate_teacher!
  before_action :test_results_from_file, only: [:show, :destroy]

  # GET /uploaded_test_results
  # GET /uploaded_test_results.json
  def index
    @test_results_from_files = Paginate.get_records(
        relation_object: current_teacher.test_results_from_files,
        page: params[:page],
        per_page: params[:per_page]
      )
  end

  # GET /uploaded_test_results/1
  # GET /uploaded_test_results/1.json
  def show
    @test_results = Paginate.get_records(
        relation_object: @test_results_from_file.test_results,
        page: params[:page],
        per_page: params[:per_page]
      )
  end

  # GET /uploaded_test_results/new
  def new
    @test_results_from_file = TestResultsFromFile.new
  end

  # POST /uploaded_test_results
  # POST /uploaded_test_results.json
  def create
    @test_results_from_file = TestResultsFromFile.new(test_results_from_file_params)
    @test_results_from_file.school_branch = current_school_branch
    @test_results_from_file.creator = current_teacher || current_entity

    respond_to do |format|
      if @test_results_from_file.save
        TestResultParserWorker.perform_async @test_results_from_file.id

        format.html { redirect_to uploaded_test_result_path(@test_results_from_file), notice: 'Document uploaded successfully.' }
        format.js { set_flash_messages type: 'notice', message: 'Document uploaded successfully..' }
        format.json { render :show, status: :created, location: @test_results_from_file }
      else
        format.html { render :new }
        format.js { set_flash_messages type: 'error', message: 'Error in uploading document' }
        format.json { render json: @test_results_from_file.errors, status: :unprocessable_entity }
      end
    end
  end

  # DELETE /uploaded_test_results/1
  # DELETE /uploaded_test_results/1.json
  def destroy
    @test_results_from_file.destroy
    respond_to do |format|
      format.html { redirect_to uploaded_test_results_url, notice: 'Document destroyed successfully.' }
      format.json { head :no_content }
    end
  end

  private
    # Use callbacks to share common setup or constraints between actions.
    def test_results_from_file
      @test_results_from_file = current_teacher.test_results_from_files.find(params[:id])
    end

    # Never trust parameters from the scary internet, only allow the white list through.
    def test_results_from_file_params
      params.require(:test_results_from_file).permit(:name)
    end
end
