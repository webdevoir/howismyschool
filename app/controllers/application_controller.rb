class ApplicationController < ActionController::Base
  # Prevent CSRF attacks by raising an exception.
  # For APIs, you may want to use :null_session instead.
  protect_from_forgery with: :exception

  helper_method :current_session_nil?, :current_entity_type


  protected

  def current_session?
    current_teacher || current_school_controller || current_manager || current_admin
  end

  def current_session_nil?
    !current_session?    
  end

  def current_entity_type
    session[:current_entity_type] ||= case 
      when current_admin
        "admin"
      when current_teacher
        "teacher"
      when current_school_controller
        "school_controller"
      when current_manager
        "manager"
      else
        "guest"
      end
  end       

end
